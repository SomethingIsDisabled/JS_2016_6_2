<?php

namespace Home\Controller;

use Think\Controller;

class ArticleslistController extends BaseController{
    //资讯中心页面
    public function lists(){
        $post=M("post");
//        $list=$post->where("status=1")->select();
//        $this->assign("list",$list);

        $count=$post->where("status=1")->count();
        $Page=new \Think\Page($count,20);
        $show=$Page->show1();
        $lists=$post->field("id,title,time,type,status")->where("status=1")->order("time desc")->limit($Page->firstRow.','
            .$Page->listRows)->select();
        $this->assign("lists",$lists);
        $this->assign("page",$show);
        $this->display();
    }
    //资讯中心列表跳转所显示内容页面
    public function content(){
        $id = I("get.id");
        $post=M("post");
        $content=$post->field("id,title,content,time,type,status")->where("status=1 AND id=$id")->select();
        $content[0]['content'] = htmlspecialchars_decode($content[0]['content']);
        $this->assign("content",$content[0]);
        $this->display();
     }

    //微信文章列表页面
    public function weixinArticleLists(){
        $weixin=M("yb365.t_weixin_new");
        $count= S("weixinArticleCount");
        if(!$count) {
            $count = $weixin->count();
            S("weixinArticleCount", $count,"300");
        }
        $Page=new \Think\Page($count,20);
        $show=$Page->show1();
        $weixinArticleLists=S("weixinArticleLists");
        if(!$weixinArticleLists) {
            $weixinArticleLists = $weixin->field("id,title,source,time")->order("time desc,id desc")->limit($Page->firstRow . ','
              . $Page->listRows)->select();
            S("weixinArticleLists",$weixinArticleLists,"300");
        }
        $weixinNew=D('WeixinNew');
        $exchanges = S("exchangesList");
        if(!$exchanges) {
            $exchanges = $weixinNew->lineAllExchanges();
            foreach ($weixinArticleLists as $key1 => $value1) {
                foreach ($exchanges as $key2 => $value2) {
                    if ($value2['publicnum'] == $value1['source'])
                        $weixinArticleLists[$key1]['name'] = $value2['name'];
                }
            }
            S("exchangesList", $exchanges,"43200");
        }
//        print_r($weixinArticleLists);
//        print_r($exchangeNum);
        $this->assign("weixinArticleLists",$weixinArticleLists);
        $this->assign("page",$show);
        $this->assign("exchangesList",$exchanges);
        $this->display();
    }
    //微信文章内容页面
    public function weixinArticleContent(){
        $id=I("get.id");
        $articleLists=M("yb365.t_weixin_new");
        $weixinArticleContent=$articleLists->field("id,title,source,time,content")->where("id=".$id)->select();
        $weixinArticleContent[0]['content']=htmlspecialchars_decode($weixinArticleContent[0]['content']);
//        print_r($weixinArticleContent[0]);exit;
//        print_r($this->tc);exit;
        $this->assign("weixinContent",$weixinArticleContent[0]);
        $this->display();
    }
    //根据公众号选取文章
    public function showExchanges(){
        $data['exchangeArticle']=I("get.exchange");
        $data['page']=I("get.page")|0;
        $weixin=D('WeixinNew');
        $list=$weixin->lineArticleBySource($data);
        return $this->ajaxReturn($list,"JSON");
    }
    //文章数量
    public function exchangeCount(){
        $data['exchangeArticle']=I("get.exchangeArticle");
        $weixin=D("WeixinNew");
        $count=$weixin->lineExchangeArticleNum($data);
        return $this->ajaxReturn($count,"JSON");
    }
}
