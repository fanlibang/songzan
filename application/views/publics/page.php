<?php
//$total_page $page_list $count $page 5
$page_style = isset($page_style, $page) ? $page_style : null;

if($page_type = 'href'){//跳转页面分页
?>
<?php if($count > 0){ ?>
<div class="page">
	<p>
		<?php if($page > 1){ ?>
			<a href="<?php echo $page_url.'&page='. ($page - 1); ?>" style="width: 56px"><?php echo format_page_style('上一页', $page_style, $page); ?></a>
		<?php }else{ ?>
			<a class="cur" style="width: 56px"><?php echo format_page_style('上一页', $page_style, $page); ?></a>
		<?php } ?>

		<?php
			if($total_page < 5) {//小于5页
				for($i = 1; $i <= $total_page; $i++){
		?>
			<a <?php echo $i == $page ? 'class="cur "': ''; ?> href="<?php echo $page_url.'&page='.$i; ?>"><?php echo format_page_style($i, $page_style, $page); ?></a>
		<?php
				}
			}else{//大于5页
		?>
		<?php
			if(in_array($page, array(1,2))){
				for ($i = 1; $i < 4; $i++) {
		?>
			<a <?php echo $i == $page ? 'class="cur"': ''; ?> href="<?php echo $page_url.'&page='.$i; ?>"><?php echo format_page_style($i, $page_style, $page); ?></a>
		<?php
				}
		?>
			<span>...</span>
			<a href="<?php echo $page_url.'&page='.$total_page; ?>"><?php echo format_page_style($total_page, $page_style, $page); ?></a>
		<?php
			}elseif($page >= $total_page || $page == ($total_page - 1)){
		?>
			<a href="<?php echo $page_url.'&page=1'; ?>"><?php echo format_page_style(1, $page_style, $page) ?></a>
			<span>...</span>
		<?php
				for ($i = ($total_page - 2); $i <= $total_page; $i++) {
		?>
			<a <?php echo $i == $page ? 'class="cur"': ''; ?> href="<?php echo $page_url.'&page='.$i; ?>"><?php echo format_page_style($i, $page_style, $page); ?></a>
		<?php
				}
			}elseif($page == 3){
				for ($i = 1; $i <= 4; $i++) {
		?>
			<a <?php echo $i == $page ? 'class="cur"': ''; ?> href="<?php echo $page_url.'&page='.$i; ?>"><?php echo format_page_style($i, $page_style, $page); ?></a>
		<?php
				}
		?>
			<span>...</span>
			<a href="<?php echo $page_url.'&page='.$total_page; ?>"><?php echo format_page_style($total_page, $page_style, $page); ?></a>
		<?php
			}elseif($page == ($total_page - 2)){
		?>
			<a href="<?php echo $page_url.'&page=1'; ?>"><?php echo format_page_style(1, $page_style, $page); ?></a>
			<span>...</span>
			<?php
				for ($i = ($total_page - 3); $i <= $total_page; $i++) {
			?>
			<a <?php echo $i == $page ? 'class="cur"': ''; ?> href="<?php echo $page_url.'&page='.$i; ?>"><?php echo format_page_style($i, $page_style, $page); ?></a>
		<?php
				}
			}else{
			$from = $page - 1;
			$get  = $page + 1;
		?>
			<a href="<?php echo $page_url.'&page=1'; ?>"><?php echo format_page_style(1, $page_style, $page); ?></a>
			<span>...</span>
		<?php
				for ($i = $from; $i <= $get; $i++) {
		?>
			<a <?php echo $i == $page ? 'class="cur"': ''; ?> href="<?php echo $page_url.'&page='.$i; ?>"><?php echo format_page_style($i, $page_style, $page); ?></a>
		<?php
				}
		?>
			<span>...</span>
			<a href="<?php echo $page_url.'&page='.$total_page; ?>"><?php echo format_page_style($total_page, $page_style, $page); ?></a>
		<?php
			}
		}
		?>

		<?php if($page < $total_page){ ?>
			<a href="<?php echo $page_url.'&page='. ($page+1); ?>"  style="width: 56px"><?php echo format_page_style('下一页', $page_style, $page); ?></a>
		<?php }else{ ?>
			<a class="cur"  style="width: 56px"><?php echo format_page_style('下一页', $page_style, $page); ?></a>
		<?php } ?>
		<span style="display: none">共有<?php echo $total_page; ?>条记录，</span>
		<span><?php echo $page . '/' . $total_page; ?>页</span>
		<span>跳转到：</span>
		<span>
			<input type="text" class="inputbox" value="<?php echo $page; ?>" style="color: #a1a1a1;width:40px;">&nbsp;&nbsp;
			<a class="testAcountMainConfirm _jump_page" data-href="<?php echo $page_url.'&page='; ?>" style="cursor: pointer">GO</a>
		</span>
	</p>
</div>

<?php } }else{//js ajax 分页 ?>

<?php } ?>
