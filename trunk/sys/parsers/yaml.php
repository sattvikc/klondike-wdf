<?php
  class YAMLNode {
    var $parent;
    var $id;
    var $data;
    var $indent;
    var $children = false;
    function YAMLNode($nodeId) {
      $this->id = $nodeId;
    }
  }
  class Spyc {
    function YAMLLoad($input) {
      $spyc = new Spyc;
      return $spyc->load($input);
    }
    function YAMLDump($array,$indent = false,$wordwrap = false) {
      $spyc = new Spyc;
      return $spyc->dump($array,$indent,$wordwrap);
    }
    function load($input) {
      if (!empty($input) && (strpos($input, "\n") === false)
          && file_exists($input)) {
        $yaml = file($input);
      } else {
        $yaml = explode("\n",$input);
      }
      $base              = new YAMLNode (1);
      $base->indent      = 0;
      $this->_lastIndent = 0;
      $this->_lastNode   = $base->id;
      $this->_inBlock    = false;
      $this->_isInline   = false;
      $this->_nodeId     = 2;

      foreach ($yaml as $linenum => $line) {
        $ifchk = trim($line);
        if (preg_match('/^(\t)+(\w+)/', $line)) {
          $err = 'ERROR: Line '. ($linenum + 1) .' in your input YAML begins'.
                 ' with a tab.  YAML only recognizes spaces.  Please reformat.';
          die($err);
        }

        if ($this->_inBlock === false && empty($ifchk)) {
          continue;
        } elseif ($this->_inBlock == true && empty($ifchk)) {
          $last =& $this->_allNodes[$this->_lastNode];
          $last->data[key($last->data)] .= "\n";
        } elseif ($ifchk{0} != '#' && substr($ifchk,0,3) != '---') {
          $node         = new YAMLNode ($this->_nodeId);
		  $this->_nodeId++;

          $node->indent = $this->_getIndent($line);
          if ($this->_lastIndent == $node->indent) {
            if ($this->_inBlock === true) {
              $parent =& $this->_allNodes[$this->_lastNode];
              $parent->data[key($parent->data)] .= trim($line).$this->_blockEnd;
            } else {
              if (isset($this->_allNodes[$this->_lastNode])) {
                $node->parent = $this->_allNodes[$this->_lastNode]->parent;
              }
            }
          } elseif ($this->_lastIndent < $node->indent) {
            if ($this->_inBlock === true) {
              $parent =& $this->_allNodes[$this->_lastNode];
              $parent->data[key($parent->data)] .= trim($line).$this->_blockEnd;
            } elseif ($this->_inBlock === false) {
              $node->parent = $this->_lastNode;
              $parent =& $this->_allNodes[$node->parent];
              $this->_allNodes[$node->parent]->children = true;
              if (is_array($parent->data)) {
                $chk = '';
                if (isset ($parent->data[key($parent->data)]))
                    $chk = $parent->data[key($parent->data)];
                if ($chk === '>') {
                  $this->_inBlock  = true;
                  $this->_blockEnd = ' ';
                  $parent->data[key($parent->data)] =
                        str_replace('>','',$parent->data[key($parent->data)]);
                  $parent->data[key($parent->data)] .= trim($line).' ';
                  $this->_allNodes[$node->parent]->children = false;
                  $this->_lastIndent = $node->indent;
                } elseif ($chk === '|') {
                  $this->_inBlock  = true;
                  $this->_blockEnd = "\n";
                  $parent->data[key($parent->data)] =
                        str_replace('|','',$parent->data[key($parent->data)]);
                  $parent->data[key($parent->data)] .= trim($line)."\n";
                  $this->_allNodes[$node->parent]->children = false;
                  $this->_lastIndent = $node->indent;
                }
              }
            }
          } elseif ($this->_lastIndent > $node->indent) {
            if ($this->_inBlock === true) {
              $this->_inBlock = false;
              if ($this->_blockEnd = "\n") {
                $last =& $this->_allNodes[$this->_lastNode];
                $last->data[key($last->data)] =
                      trim($last->data[key($last->data)]);
              }
            }
            foreach ($this->_indentSort[$node->indent] as $n) {
              if ($n->indent == $node->indent) {
                $node->parent = $n->parent;
              }
            }
          }

          if ($this->_inBlock === false) {
            $this->_lastIndent = $node->indent;
            $this->_lastNode = $node->id;
            $node->data = $this->_parseLine($line);
            $this->_allNodes[$node->id] = $node;
            $this->_allParent[intval($node->parent)][] = $node->id;
            $this->_indentSort[$node->indent][] =& $this->_allNodes[$node->id];
            if (
              ( (is_array($node->data)) &&
                isset($node->data[key($node->data)]) &&
                (!is_array($node->data[key($node->data)])) )
              &&
              ( (preg_match('/^&([^ ]+)/',$node->data[key($node->data)]))
                ||
                (preg_match('/^\*([^ ]+)/',$node->data[key($node->data)])) )
            ) {
                $this->_haveRefs[] =& $this->_allNodes[$node->id];
            } elseif (
              ( (is_array($node->data)) &&
                isset($node->data[key($node->data)]) &&
                 (is_array($node->data[key($node->data)])) )
            ) {
              foreach ($node->data[key($node->data)] as $d) {
                if ( !is_array($d) &&
                  ( (preg_match('/^&([^ ]+)/',$d))
                    ||
                    (preg_match('/^\*([^ ]+)/',$d)) )
                  ) {
                    $this->_haveRefs[] =& $this->_allNodes[$node->id];
                }
              }
            }
          }
        }
      }
      unset($node);
      $this->_linkReferences();
      $trunk = $this->_buildArray();
      return $trunk;
    }
    function dump($array,$indent = false,$wordwrap = false) {
      if ($indent === false or !is_numeric($indent)) {
        $this->_dumpIndent = 2;
      } else {
        $this->_dumpIndent = $indent;
      }

      if ($wordwrap === false or !is_numeric($wordwrap)) {
        $this->_dumpWordWrap = 40;
      } else {
        $this->_dumpWordWrap = $wordwrap;
      }
      $string = "---\n";
      foreach ($array as $key => $value) {
        $string .= $this->_yamlize($key,$value,0);
      }
      return $string;
    }
    var $_haveRefs;
    var $_allNodes;
    var $_allParent;
    var $_lastIndent;
    var $_lastNode;
    var $_inBlock;
    var $_isInline;
    var $_dumpIndent;
    var $_dumpWordWrap;
    var $_nodeId;
    function _yamlize($key,$value,$indent) {
      if (is_array($value)) {
        $string = $this->_dumpNode($key,NULL,$indent);
        $indent += $this->_dumpIndent;
        $string .= $this->_yamlizeArray($value,$indent);
      } elseif (!is_array($value)) {
        $string = $this->_dumpNode($key,$value,$indent);
      }
      return $string;
    }
    function _yamlizeArray($array,$indent) {
      if (is_array($array)) {
        $string = '';
        foreach ($array as $key => $value) {
          $string .= $this->_yamlize($key,$value,$indent);
        }
        return $string;
      } else {
        return false;
      }
    }
    function _dumpNode($key,$value,$indent) {
      if (strpos($value,"\n") !== false || strpos($value,": ") !== false || strpos($value,"- ") !== false) {
        $value = $this->_doLiteralBlock($value,$indent);
      } else {
        $value  = $this->_doFolding($value,$indent);
      }

      if (is_bool($value)) {
        $value = ($value) ? "true" : "false";
      }

      $spaces = str_repeat(' ',$indent);

      if (is_int($key)) {
        $string = $spaces.'- '.$value."\n";
      } else {
        $string = $spaces.$key.': '.$value."\n";
      }
      return $string;
    }
    function _doLiteralBlock($value,$indent) {
      $exploded = explode("\n",$value);
      $newValue = '|';
      $indent  += $this->_dumpIndent;
      $spaces   = str_repeat(' ',$indent);
      foreach ($exploded as $line) {
        $newValue .= "\n" . $spaces . trim($line);
      }
      return $newValue;
    }
    function _doFolding($value,$indent) {
      if ($this->_dumpWordWrap === 0) {


        return $value;
      }

      if (strlen($value) > $this->_dumpWordWrap) {
        $indent += $this->_dumpIndent;
        $indent = str_repeat(' ',$indent);
        $wrapped = wordwrap($value,$this->_dumpWordWrap,"\n$indent");
        $value   = ">\n".$indent.$wrapped;
      }
      return $value;
    }
    function _getIndent($line) {
      preg_match('/^\s{1,}/',$line,$match);
      if (!empty($match[0])) {
        $indent = substr_count($match[0],' ');
      } else {
        $indent = 0;
      }
      return $indent;
    }
    function _parseLine($line) {
      $line = trim($line);

      $array = array();

      if (preg_match('/^-(.*):$/',$line)) {
        $key         = trim(substr(substr($line,1),0,-1));
        $array[$key] = '';
      } elseif ($line[0] == '-' && substr($line,0,3) != '---') {
        if (strlen($line) > 1) {
          $value   = trim(substr($line,1));
          $value   = $this->_toType($value);
          $array[] = $value;
        } else {
          $array[] = array();
        }
      } elseif (preg_match('/^(.+):/',$line,$key)) {
        if (preg_match('/^(["\'](.*)["\'](\s)*:)/',$line,$matches)) {
          $value = trim(str_replace($matches[1],'',$line));
          $key   = $matches[2];
        } else {
          $explode = explode(':',$line);
          $key     = trim($explode[0]);
          array_shift($explode);
          $value   = trim(implode(':',$explode));
        }
        $value = $this->_toType($value);
        if (empty($key)) {
          $array[]     = $value;
        } else {
          $array[$key] = $value;
        }
      }
      return $array;
    }
    function _toType($value) {
      if (preg_match('/^("(.*)"|\'(.*)\')/',$value,$matches)) {
       $value = (string)preg_replace('/(\'\'|\\\\\')/',"'",end($matches));
       $value = preg_replace('/\\\\"/','"',$value);
      } elseif (preg_match('/^\\[(.+)\\]$/',$value,$matches)) {
        $explode = $this->_inlineEscape($matches[1]);
        $value  = array();
        foreach ($explode as $v) {
          $value[] = $this->_toType($v);
        }
      } elseif (strpos($value,': ')!==false && !preg_match('/^{(.+)/',$value)) {
          $array = explode(': ',$value);
          $key   = trim($array[0]);
          array_shift($array);
          $value = trim(implode(': ',$array));
          $value = $this->_toType($value);
          $value = array($key => $value);
      } elseif (preg_match("/{(.+)}$/",$value,$matches)) {
        $explode = $this->_inlineEscape($matches[1]);
        $array = array();
        foreach ($explode as $v) {
          $array = $array + $this->_toType($v);
        }
        $value = $array;
      } elseif (strtolower($value) == 'null' or $value == '' or $value == '~') {
        $value = NULL;
      } elseif (preg_match ('/^[0-9]+$/', $value)) {
        $value = (int)$value;
      } elseif (in_array(strtolower($value),
                  array('true', 'on', '+', 'yes', 'y'))) {
        $value = true;
      } elseif (in_array(strtolower($value),
                  array('false', 'off', '-', 'no', 'n'))) {
        $value = false;
      } elseif (is_numeric($value)) {
        $value = (float)$value;
      } else {
        $value = trim(preg_replace('/#(.+)$/','',$value));
      }

      return $value;
    }
    function _inlineEscape($inline) {

      $saved_strings = array();
      $regex = '/(?:(")|(?:\'))((?(1)[^"]+|[^\']+))(?(1)"|\')/';
      if (preg_match_all($regex,$inline,$strings)) {
        $saved_strings = $strings[0];
        $inline  = preg_replace($regex,'YAMLString',$inline);
      }
      unset($regex);
      if (preg_match_all('/\[(.+)\]/U',$inline,$seqs)) {
        $inline = preg_replace('/\[(.+)\]/U','YAMLSeq',$inline);
        $seqs   = $seqs[0];
      }
      if (preg_match_all('/{(.+)}/U',$inline,$maps)) {
        $inline = preg_replace('/{(.+)}/U','YAMLMap',$inline);
        $maps   = $maps[0];
      }

      $explode = explode(', ',$inline);
      if (!empty($seqs)) {
        $i = 0;
        foreach ($explode as $key => $value) {
          if (strpos($value,'YAMLSeq') !== false) {
            $explode[$key] = str_replace('YAMLSeq',$seqs[$i],$value);
            ++$i;
          }
        }
      }
      if (!empty($maps)) {
        $i = 0;
        foreach ($explode as $key => $value) {
          if (strpos($value,'YAMLMap') !== false) {
            $explode[$key] = str_replace('YAMLMap',$maps[$i],$value);
            ++$i;
          }
        }
      }
      if (!empty($saved_strings)) {
        $i = 0;
        foreach ($explode as $key => $value) {
          while (strpos($value,'YAMLString') !== false) {
            $explode[$key] = preg_replace('/YAMLString/',$saved_strings[$i],$value, 1);
            ++$i;
            $value = $explode[$key];
          }
        }
      }

      return $explode;
    }
    function _buildArray() {
      $trunk = array();

      if (!isset($this->_indentSort[0])) {
        return $trunk;
      }

      foreach ($this->_indentSort[0] as $n) {
        if (empty($n->parent)) {
          $this->_nodeArrayizeData($n);
          $this->_makeReferences($n);
          $trunk = $this->_array_kmerge($trunk,$n->data);
        }
      }

      return $trunk;
    }
    function _linkReferences() {
      if (is_array($this->_haveRefs)) {
        foreach ($this->_haveRefs as $node) {
          if (!empty($node->data)) {
            $key = key($node->data);
            if (is_array($node->data[$key])) {
              foreach ($node->data[$key] as $k => $v) {
                $this->_linkRef($node,$key,$k,$v);
              }
            } else {
              $this->_linkRef($node,$key);
            }
          }
        }
      }
      return true;
    }

    function _linkRef(&$n,$key,$k = NULL,$v = NULL) {
      if (empty($k) && empty($v)) {
        if (preg_match('/^&([^ ]+)/',$n->data[$key],$matches)) {
          $this->_allNodes[$n->id]->ref = substr($matches[0],1);
          $this->_allNodes[$n->id]->data[$key] =
                   substr($n->data[$key],strlen($matches[0])+1);
        } elseif (preg_match('/^\*([^ ]+)/',$n->data[$key],$matches)) {
          $ref = substr($matches[0],1);
          $this->_allNodes[$n->id]->refKey =  $ref;
        }
      } elseif (!empty($k) && !empty($v)) {
        if (preg_match('/^&([^ ]+)/',$v,$matches)) {
          $this->_allNodes[$n->id]->ref = substr($matches[0],1);
          $this->_allNodes[$n->id]->data[$key][$k] =
                              substr($v,strlen($matches[0])+1);
        } elseif (preg_match('/^\*([^ ]+)/',$v,$matches)) {
          $ref = substr($matches[0],1);
          $this->_allNodes[$n->id]->refKey =  $ref;
        }
      }
    }
    function _gatherChildren($nid) {
      $return = array();
      $node   =& $this->_allNodes[$nid];
      if (is_array ($this->_allParent[$node->id])) {
        foreach ($this->_allParent[$node->id] as $nodeZ) {
          $z =& $this->_allNodes[$nodeZ];
          $this->_nodeArrayizeData($z);
          $this->_makeReferences($z);
          $return = $this->_array_kmerge($return,$z->data);
        }
      }
      return $return;
    }
    function _nodeArrayizeData(&$node) {
      if (is_array($node->data) && $node->children == true) {
        $childs = $this->_gatherChildren($node->id);
        $key = key($node->data);
        $key = empty($key) ? 0 : $key;
        if (isset ($node->data[$key])) {
            if (is_array($node->data[$key])) {
              $node->data[$key] = $this->_array_kmerge($node->data[$key],$childs);
            } else {
              $node->data[$key] = $childs;
            }
        } else {
            $node->data[$key] = $childs;
        }
      } elseif (!is_array($node->data) && $node->children == true) {
        $childs       = $this->_gatherChildren($node->id);
        $node->data   = array();
        $node->data[] = $childs;
      }
      return true;
    }
    function _makeReferences(&$z) {
      if (isset($z->ref)) {
        $key                = key($z->data);
        $this->ref[$z->ref] =& $z->data[$key];
      } elseif (isset($z->refKey)) {
        if (isset($this->ref[$z->refKey])) {
          $key           = key($z->data);
          $z->data[$key] =& $this->ref[$z->refKey];
        }
      }
      return true;
    }
    function _array_kmerge($arr1,$arr2) {
      if(!is_array($arr1)) $arr1 = array();
      if(!is_array($arr2)) $arr2 = array();

      $keys  = array_merge(array_keys($arr1),array_keys($arr2));
      $vals  = array_merge(array_values($arr1),array_values($arr2));
      $ret   = array();
      foreach($keys as $key) {
        list($unused,$val) = each($vals);
        if (isset($ret[$key]) and is_int($key)) $ret[] = $val; else $ret[$key] = $val;
      }
      return $ret;
    }
  }
?>