<div class="panelBar">
<div class="pages">
        <span>显示</span>
        <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value}<?php echo $page_box ? ",'jbsxBox1'" : ''; ?>)">
            <?php
            foreach($page_list_arr as $v){
                echo '<option value="'.$v.'" '.($page_list == $v ? 'selected':'').'>'.$v.'</option>';
            }
            ?>
        </select>
        <span>条，共<?php echo $count > 0 ? ceil($count/$page_list) : 0;?>页，<?php echo $count;?>条数据</span>
    </div>
    <div class="pagination"
        <?php echo $page_box ? ' rel="jbsxBox1" ' : ' targetType="navTab" '; ?>
         totalCount="<?php echo $count;?>"
         numPerPage="<?php echo $page_list;?>"
         pageNumShown="5"
         currentPage="<?php echo $page;?>"></div>
</div>