<?php

class Gallery{

protected $galleryInstance = 'galleryInstance_1';

function __construct(){

 setExtraThing($this->getMediaGalleryCSS());

 setExtraThing($this->getMediaGalleryJs());

}

 



function getMediaGallery($instance,$attr=array()){

$url=MAINSITE_MADMIN_URL.'media/iframe_media'; 

$button   = isset($attr['button'])?$attr['button']:'Browse Media';

$multiple = isset($attr['multiple'])?(string)$attr['multiple']:'true';

$limit    = isset($attr['limit'])?$attr['limit']:'unlimited';

$class    = isset($attr['class'])?$attr['class']:'btn btn-primary';

$instance = trim($instance)==''?$this->galleryInstance:$instance;

$html = '<a href="'.$url.'"';

$html.= 'class="media-browser various fancybox.iframe"';

$html.= 'multiple-select="'.$multiple.'" limit="'.$limit.'"';

$html.= 'media-data="'.strip_tags($instance).'">';

$html.= '<button class="'.$class.'">'.strip_tags($button).'</button>';

$html.= '</a>';

return $html;

}



function getMediaGallery2($instance,$attr=array()){

$url=MAINSITE_MADMIN_URL.'media/iframe_media'; 

$button   = isset($attr['button'])?$attr['button']:'Browse Media';

$multiple = isset($attr['multiple'])?(string)$attr['multiple']:'true';

$limit    = isset($attr['limit'])?$attr['limit']:'unlimited';

$class    = isset($attr['class'])?$attr['class']:'btn btn-primary';

$instance = trim($instance)==''?$this->galleryInstance:$instance;

$html = '<a href="'.$url.'"';

$html.= 'class="media-browser various fancybox.iframe"';

$html.= 'multiple-select="'.$multiple.'" limit="'.$limit.'"';

$html.= 'media-data="'.strip_tags($instance).'">';

$html.= '<button class="'.$class.'">'.strip_tags($button).'</button>';

$html.= '</a>';

return $html;

}







function getMediabannerGallery($instance,$attr=array()){

$button   = isset($attr['button'])?$attr['button']:'Browse Media';

$multiple = isset($attr['multiple'])?(string)$attr['multiple']:'true';

$limit    = isset($attr['limit'])?$attr['limit']:'unlimited';

$class    = isset($attr['class'])?$attr['class']:'btn btn-primary';

$instance = trim($instance)==''?$this->galleryInstance:$instance;

$html = '<a href="'.MAINSITE_MADMIN_URL.'"media/iframe-media"';

$html.= 'class="media-browser various fancybox.iframe"';

$html.= 'multiple-select="'.$multiple.'" limit="'.$limit.'"';

$html.= 'media-data="'.strip_tags($instance).'">';

$html.= '<button class="'.$class.'">'.strip_tags($button).'</button>';

$html.= '</a>';

return $html;

}





function getMediaGalleryJs(){

$js ='<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>'."\n";

$js.='<script type="text/javascript" src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/fancybox/fancybox.js"></script>'."\n";

$js.='<script>'."\n";

$js.='var jq = $.noConflict();'."\n";

$js.='jq(document).ready(function() {'."\n";

$js.='jq(".various").fancybox({'."\n";

$js.='fitToView : true,'."\n";

$js.='padding : 0,'."\n";

$js.='minWidth : 920,'."\n";

$js.='autoSize : false,'."\n";

$js.='closeClick	: false,'."\n";

$js.='openEffect	: \'elastic\','."\n";

$js.='width       : \'100%\','."\n";

$js.='height      : \'100%\','."\n";

$js.='scrolling   :  \'no\','."\n";

$js.='afterShow   : function () {'."\n";

$js.=' $(\'iframe.fancybox-iframe\').contents().find(\'body\').attr(\'id\',$(this.element).attr(\'media-data\'));'."\n";

$js.='/*set property for enable multiple or single select*/'."\n";

$js.='$(\'iframe.fancybox-iframe\').contents().find(\'body\').attr(\'multiple-select\',$(this.element).attr(\'multiple-select\'));'."\n";

$js.='/*set limit to select image*/'."\n";

$js.='$(\'iframe.fancybox-iframe\').contents().find(\'body\').attr(\'limit\',$(this.element).attr(\'limit\'));'."\n";

$js.='/*select images on gallery which is available*/'."\n";

$js.='$(\'.media-delete-btn\').each(function(){'."\n";

$js.='$(\'iframe.fancybox-iframe\').contents().find("input[value=\'"+$(this).val()+"\'].media-delete-btn").attr("checked","checked");'."\n";

$js.='});'."\n";

$js.=' },'."\n";

$js.='helpers     : {'."\n";

$js.='overlay     : {'."\n";

$js.='css     : {\'background\' : \'rgba(51,51,51,0.93)\'}'."\n";

$js.=' }'."\n";

$js.='}'."\n";

$js.='});'."\n";

$js.='});'."\n";

$js.='function deleteVirtualMedia(btnobj){$(btnobj).parent().fadeOut(\'slow\',function(){$(this).remove();});}'."\n";

$js.='</script>'."\n";

return $js;

}

 

function getMediaGalleryCSS(){

   return '<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/fancybox/fancybox.css" type="text/css" media="screen" />';

}

  

 

}