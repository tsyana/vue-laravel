<?php

namespace App\Http\Controllers;

use App\Model\Ofo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Sunra\PhpSimple\HtmlDomParser;


class OfoController extends Controller
{
    public static $NAME = 'QD';
    /**
     * todo :
     * 接口分页， 智能连接
     */
    public function doFetch(Request $request) {
        if(!$request->cid){
            $categoryId = 0;
        }else {
            $categoryId = $request->cid;
        }
        $this->parseRequest($categoryId);

        return;
    }

    private function parseRequest($cid) {
        //========配置参数============

        $DEPTH_COUNT = 4;           //抓取分页的深度
        $MIN_VIEW_COUNT = 10000;    //最小阅读数

        //==========================
        $categoryId = $cid;


        for($i = 0; $i < $DEPTH_COUNT; $i++) {
            //目标url
            if($i == 0){
                //第0页的内容需要特殊处理
                $targetUrl = "http://weixin.sogou.com/pcindex/pc/pc_{$i}/pc_{$i}.html";
            }else{
                $targetUrl = "http://weixin.sogou.com/pcindex/pc/pc_{$categoryId}/{$i}.html";
            }

//            Log::info($targetUrl);
            $dom = HtmlDomParser::file_get_html($targetUrl);

            foreach($dom->find('li') as $element){
                $itemToInsert = array();
                //收藏数
                $viewCountTxt = $element->find('.wx-news-info2 .s-p', 0)->innertext;
                //先取出 阅读数 xxx
                preg_match("/阅读&nbsp;.+?&nbsp;/", $viewCountTxt,$viewCountTxt);
                //正则取数字
                preg_match("/\d+/", $viewCountTxt[0],$viewCountTxt);
                $itemToInsert['view_count'] = $viewCountTxt[0];
                if(intval($viewCountTxt[0]) < $MIN_VIEW_COUNT) {
                    continue;
                }

                //公众号名字
                $itemToInsert['wx_name'] = $element->find('.pos-wxrw a', 0)->find('p', 1)->innertext;
                //avatar
                $itemToInsert['wx_avatar'] = $element->find('.pos-wxrw img', 0)->src;


                //标题
                $itemToInsert['title'] = $viewCountTxt = $element->find('.wx-news-info2 h4', 0)->find('a',0)->innertext;
                //简述
                $itemToInsert['description'] = $element->find('.wx-news-info2 a', 1)->innertext;
                //文章链接
                $itemToInsert['article_link'] = $element->find('.wx-news-info2 a', 1)->href;
                $itemToInsert['article_thumb'] = $element->find('.wx-img-box a img',0)->src;
                $itemToInsert['topic_category'] = $categoryId;
                $existItem = ArticleBrief::where('title', '=', $itemToInsert['title'])
                    ->where('wx_name', '=', $itemToInsert['wx_name'])->get();

//            $this->info(date("h:i:sa"));
//                Log::info($itemToInsert);
                if(sizeof($existItem)==0){
                    //没有记录，插入新的
                    ArticleBrief::create($itemToInsert);
                }else{
                    //更新阅读量的信息

                }
            }
        }
    }


    /**
     * 供php内置定时任务调用的数据抓取
     */
    public function cmdFetchData() {
        $varObj = GlobalVar::where('key', 'cid')->find(1);
        $cid = intval($varObj->value);
        $this->parseRequest($cid);
        //更新下一次要抓取的cid字符串
        $varObj->value = ++$cid;
        if($varObj->value >= 19){
            $varObj->value = 0;
        }
        $varObj->save( );
    }

    public function getCategory( ) {
        return [
            ['name'=>'热门', 'value' => '0'],
            ['name'=>'推荐', 'value' => '1'],
            ['name'=>'段子手', 'value' => '2'],
            ['name'=>'养生堂', 'value' => '3'],
            ['name'=>'私房话', 'value' => '4'],
            ['name'=>'八卦精', 'value' => '5'],
            ['name'=>'爱生活', 'value' => '6'],
            ['name'=>'财经迷', 'value' => '7'],
            ['name'=>'汽车迷', 'value' => '8'],
            ['name'=>'潮人帮', 'value' => '9'],
            ['name'=>'科技咖', 'value' => '10'],
            ['name'=>'辣妈帮', 'value' => '11'],
            ['name'=>'点赞党', 'value' => '12'],
            ['name'=>'旅行家', 'value' => '13'],
            ['name'=>'职场人', 'value' => '14'],
            ['name'=>'美食家', 'value' => '15'],
            ['name'=>'古今通', 'value' => '16'],
            ['name'=>'学霸族', 'value' => '17'],
            ['name'=>'星座控', 'value' => '18'],
            ['name'=>'体育迷', 'value' => '19']
        ];
    }

    public function getList(Request $request) {
        $page = intval($request->page);
        $COUNT_PER_PAGE = 20;
        $result = ArticleBrief::where('topic_category', $request->cid)
                ->skip($COUNT_PER_PAGE * $page)
                ->take($COUNT_PER_PAGE)->orderBy('created_at', 'DESC')->get();
        return $result;
    }
}
