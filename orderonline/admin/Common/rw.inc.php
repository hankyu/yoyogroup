<?php
/*
 * rw.inc.php :: Main RobotAway class include file
 * version 0.1
 * copyright (c) 2007 by Ricky Su
 * RobotAway is an open source PHP class library to prevent
 * "nonpeople" submiting from.
 *
 * RobotAway is released under the terms of the LGPL license
 * http://www.gnu.org/copyleft/lesser.html#SEC3
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *      
*/
 class RobotAway
 {
  var $VerifyKey;
  var $EncodeKey;
  var $ElementID;
  var $Prefix;
  var $TimeOut;
  var $CheckFunctionName;
  function __construct($EncodeKey,$ElementID='RACheck',$TimeOut=10,$Prefix='')
  {
   $this->ElementID=$ElementID;
   $this->Prefix=$Prefix;
   $this->GenerateVerifyKey();
   $this->TimeOut=$TimeOut;
   $this->CheckFunctionName=$this->Prefix.'_'.substr(md5(time().microtime().rand()),0,rand(10,32));
  }
  function CheckFunction()
  {
   return $this->CheckFunctionName.'()';
  }
  function Verify($Key=false)
  {
   if($Key===false) $Key=$_POST[$this->ElementID];
   $Time=substr($Key,0,8);
   if(($this->TimeOut)&&(hexdec($Time)+$this->TimeOut*60<time())) return false;
   $ID=substr($Key,8,32);
   if($ID!=md5($Time.$this->EncodeKey)) return false;
   $CheckValue=substr($Key,40);
   $Result=md5($ID.$this->EncodeKey);
   return ($Result==$CheckValue);
  }
  private function GenerateVerifyKey()
  {
   $Time=sprintf("%x",time());
   $ID=md5($Time.$this->EncodeKey);
   $this->VerifyKey=$Time.$ID.md5($ID.$this->EncodeKey);
  }
  private function XorEncode($Str,$Key)
  {
   $KeyLen=strlen($Key);
   $EncStr='';
   for($i=0;$i<strlen($Str);$i++)
   {
    $BinStr=hexdec(bin2hex($Str{$i}));
    $BinKey=hexdec(bin2hex($Key{$i%$KeyLen}));
    $EncStr.=pack('C',$BinStr^$BinKey);
   }
   return urlencode($EncStr);
  }
  private function GenerateRandomFunctionName()
  {
   return '_'.substr(md5(time().microtime().rand()),0,rand(10,32));
  }
  private function GenerateVarDefineString($VarArray)
  {
   $VarStrings='';
   $VarArrayCount=count($VarArray);
   for($i=0;$i<=$VarArrayCount;$i++)
   {
    $RandSwap1=rand(0,$VarArrayCount-1);
    $RandSwap2=rand(0,$VarArrayCount-1);
    $Tmp=$VarArray[$RandSwap1];
    $VarArray[$RandSwap1]=$VarArray[$RandSwap2];
    $VarArray[$RandSwap2]=$Tmp;
   }
   foreach($VarArray as $Index => $VarString)
    $VarStrings.=$VarString;
   return $VarStrings; 
  }
  private function ConfuseComment()
  {
   $ConfuseStringPatten="0123456789abcdef_+-/,'\";= ";
   $ConfuseString='';
   $Size=rand(5,10);
   for($i=0;$i<$Size;$i++)
    $ConfuseString.=$ConfuseStringPatten{rand(0,strlen($ConfuseStringPatten)-1)};
   return "/*$ConfuseString*/";
  }
  private function Confuse($String)
  {
   if(strlen($String)<=5) return $this->ConfuseComment()."'$String'".$this->ConfuseComment();
   $ConfusedString='';
   $StringLen=strlen($String);
   for($i=0;;)
   {
    $RndStrLen=rand(5,10);
    if($RndStrLen>=strlen($String)-$i-1) $RndStrLen=strlen($String)-$i;
    $ConfusedString.=$this-> ConfuseComment()."'".substr($String,$i,$RndStrLen)."'".$this-> ConfuseComment()."+";
    $i+=$RndStrLen;
    if($i>=strlen($String)-1) break;
   }
   return $this->ConfuseComment()."$ConfusedString''".$this->ConfuseComment();
  }
  function GenerateJS()
  {
   $VarName=$this->GenerateRandomFunctionName();
   $AssignFunctionName=$this->GenerateRandomFunctionName();  
   $EvalDataEncodeKey=sha1(time().microtime().rand());
   $EvalDataName=$this->GenerateRandomFunctionName();
   $EncodedFunction=$this->GenerateRandomFunctionName();
   $EvalDataEncodeKeyName=$this->GenerateRandomFunctionName();
   $RandomJSVarDefineList=array();
   $JS="var $VarName='';";
   for($i=0;;)
   {
    $RndStrLen=rand(1,10);
    if($RndStrLen>=strlen($this->VerifyKey)-$i-1) $RndStrLen=strlen($this->VerifyKey)-$i;
    $JS.="$VarName+='".substr($this->VerifyKey,$i,$RndStrLen)."';";
    $i+=$RndStrLen;
    if($i>=strlen($this->VerifyKey)-1) break;
   }
   $EvalData=$this->XorEncode("var $AssignFunctionName".'=function(){'.$JS."return $VarName;};",$EvalDataEncodeKey);
   array_push($RandomJSVarDefineList,"var $EncodedFunction=decodeURIComponent(".$this->Confuse($EvalData).");");
   array_push($RandomJSVarDefineList,"var $EvalDataEncodeKeyName=".$this->Confuse($EvalDataEncodeKey).";");
   array_push($RandomJSVarDefineList,"var $EvalDataName=".$this->Confuse('').";");
//Javascript Start
   return str_replace("\n",'',"
function ".$this->CheckFunctionName."()
{
".$this->GenerateVarDefineString($RandomJSVarDefineList)."
for(i=0;i<$EncodedFunction.length;i++)
$EvalDataName+=String.fromCharCode($EvalDataEncodeKeyName.charCodeAt(i%$EvalDataEncodeKeyName.length)^$EncodedFunction.charCodeAt(i));
eval($EvalDataName);
document.getElementById('".$this->ElementID."').value=$AssignFunctionName();
} 
");
//Javascript End
  }
 }
?>