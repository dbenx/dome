<?
/*
 *2011-1-14
 *
 *From :YumDam
 *
 *E-mail:yumdam@yumdam.com
 *
 *QQ:992360020
 *
 *http://www.yumdam.com/
 *
 */

class YumDamMSG
{
    public $Service = "http://211.147.239.62/Service/WebService.asmx?wsdl";
    public $Account = "gzgyml@gzgyml";
    public $Password = "c=FH,3591Km=";
    public $MMSName = "【贵阳美莱】";
    public $NumArray;###号码集
    public $Client;###服务器连接
    public $MsgTpl = '<smil>
  <head>
    <meta name="title" content="mms" />
    <meta name="author" content="MYLIKE" />
    <layout>
      <root-layout width="160" height="140" />
      <region id="Text" width="50" height="50" left="0" top="50" fit="hidden" />
    </layout>
  </head>
  <body>
    <par dur="5000ms">
      <text src="text.txt" region="Text" />
    </par>
  </body>
</smil>';

#public $MyGuid;

    function __construct()
    {
        $this->Client = new SoapClient($this->Service);
    }


    function Guid()
    {
        mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12);
        return $uuid;
    }


    function SetTel($numarray)
    {
        if (!is_array($numarray)) {
            $numarray = str_replace("，", ",", $numarray);
            $numarray = explode(",", $numarray);
        }
        if (is_array($numarray)) {
            foreach ($numarray as $k => $v) {
                if (!empty($v)) {
                    $this->NumArray[] = array('Phone' => $v, 'Content' => 'test', 'vipFlag' => 'false', 'customMsgID' => '', 'customNum' => '');
                }
            }
        } else {
            return false;
        }
    }

    function SendCont($Cont)
    {
        if (empty($Cont)) {
            return false;
        }
        $MyGuid = $this->Guid();
        $MediaItems[] = array('meta' => 'mms.smil', 'data' => $this->MsgTpl);
        $MediaItems[] = array('meta' => 'subject.txt', 'data' => $this->MMSName);
        $MediaItems[] = array('meta' => 'text.txt', 'data' => $Cont);
        $PostCont = array('uuid' => $MyGuid, 'batchID' => $MyGuid, 'batchName' => 'MYLIKE', 'sendType' => '0', 'msgType' => '2', 'medias' => array('MediaItems' => $MediaItems), 'msgs' => array('MessageData' => $this->NumArray), 'bizType' => '', 'distinctFlag' => '', 'scheduleTime' => '', 'deadline' => '');
        $ReCont = $this->Client->Post(array('account' => $this->Account, 'password' => $this->Password, 'mtpack' => $PostCont));
        $ReCont = get_object_vars($ReCont);//转换成数组
        $ReCont = get_object_vars($ReCont["PostResult"]);//转换成数组
        return $ReCont;
    }


}


/*
#ini_set("soap.wsdl_cache_enabled", "0");
echo time();
$SendMsg=new YumDamMSG();
$SendMsg->SetTel("13996156165,15998989668,15599150354");
$SendMsgRe=$SendMsg->SendCont("(新133600)这是一条测试内容");
# print_r($SendMsg->NumArray);
#print_r($SendMsgRe);
echo $SendMsgRe["result"];
*/
/* Array
(
    [result] => 0
    [uuid] => 380eae86-a1ec-a3eb-39c9-224e1dbfa903
    [message] => 成功
    [attributes] => <map><entry><string>success_count</string><string>1</string></entry></map>
)*/


?>