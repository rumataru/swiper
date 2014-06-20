<style>
.paginator { padding-top:6px; padding-left:2px; color:#1A588E; }
.paginator .pager { border:1px solid #327BB9; background-color: #B9D3E5; margin: 0 2px; padding:2px 5px 2px 5px;}
.paginator .pager:hover{  background-color:#fafafa; color: #C91F21; }
.paginator .pager a { text-decoration:none; }
.paginator .pager a:hover { text-decoration:none; color: #C91F21; }
.paginator .active_page { background-color:#fafafa; font-weight:bolder; }
</style>

/*
* $elements   - количество элементов
* $page       - активная страница (выбрана сейчас)
* $onlist     - количество элементов на странице
* $parameters - параметры которые необходимо передать при переходе на следующую страницу (необходимо для поиска, что бы GET параметры не терялись)
*/

function swiper($elements, $page, $onlist, $parameters)
    {
        // swiper mod 2.0
        if($elements<=0)
        {
            return '<div class="paginator"><span>Нет страниц в поиске</span></div>';
        }
            $allpages = ceil($elements/$onlist);
            $prev = ($page>0) ? '<span class="pager"><a href="?page='.($page-1).( ! empty($parameters) ? '&'.$parameters : '').'">Назад</a></span>' : ''; // если хотя бы на 2 странице, пишем НАЗАД
            $next = (($page+1)<$allpages) ? '<span class="pager"><a href="?page='.($page+1).( ! empty($parameters) ? '&'.$parameters : '').'">Вперед</a></span>' : '';    
            $begin = $end = null;
            $b = 0;
            $e = $allpages;
            $ellipsis = '<span class="pager">...</span>';
    
            if($allpages<=11)
            {
                for($i=0;$i<$allpages;$i++)
                {
                    $print .= ($page==$i) ? '<span class="pager active_page"><a href="#">'.($i+1).'</a></span>' : '<span class="pager"><a href="?page='.$i.( ! empty($parameters) ? '&'.$parameters : '').'">'.($i+1).'</a></span>';
                }
            }
            else
            {        
                if($page>=6)
                {
                    $b = $page-2;
                    for($i=0;$i<3;$i++)
                    {
                        $begin .= '<span class="pager"><a href="?page='.$i.( ! empty($parameters) ? '&'.$parameters : '').'">'.($i+1).'</a></span>';
                    }
                    $begin .= $ellipsis;
                }               
                if($page<($allpages-6))
                {
                    $e = $page+3;            
                    $end .= $ellipsis;
                    for($i=($allpages-3);$i<$allpages;$i++)
                    {
                        $end .= '<span class="pager"><a href="?page='.$i.( ! empty($parameters) ? '&'.$parameters : '').'">'.($i+1).'</a></span>';
                    }
                }    
                for($i=$b;$i<$e;$i++)
                {
                    $print .= ($page==$i) ? '<span class="pager active_page"><a href="#">'.($i+1).'</a></span>' : '<span class="pager"><a href="?page='.$i.( ! empty($parameters) ? '&'.$parameters : '').'">'.($i+1).'</a></span>';
                }
            }
        return '<div class="paginator"><span>Страница '.($page+1).' из '.$allpages.':</span>'.$prev.$begin.$print.$end.$next.'</div>';
    }
