<?php
/**
 * @version 1.0
 * Last modified by __NAME__ on __TIME__
 * 
 */
class SharHTML {
    /**
     * alert
     * @param  type of alert  $type  show different color of alert
     * @param  information  $info  information to show
     * @param  boolean $close show if exist X
     * @return String         the alert div
     */
	public static function alert($type,$info,$close=true){
		$string = "<div class='alert alert-$type'>";

		if($close){
			$string .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		}

		if(is_array($info)){
			$string .= '<ul>';
			foreach ($info as $i) {
				if($i)
					$string .= "<li>$i</li>\n";
			}
			$string .= '</ul>';
		}else{
			$string .= $info;
		}
		$string .= '</div>';
		echo $string;
	}

	/**
	 * a function to show a list
	 * the elements of list is array
	 * @param  string $menuTitle  menu's title
	 * @param  array $menu_items array of elements
	 * key is name of a elements, value is the address of elements.
	 * if there exist second list, then elements of $menu_items should be array too
	 */
	public static function sidemenu($menuTitle,$menuItems){
		echo "<h5 class=\"title\">$menuTitle</h5>\n<nav>\n<ul id=\"nav\">\n";
		    foreach($menuItems as $itemKey => $itemValue){
		      if(!is_array($itemValue)){
		    		echo "<li><a href=\"$itemValue\">$itemKey</a></li>\n";
		      }
		      else{
		    		echo "<li class=\"has_sub\"><a href=\"#\">$itemKey</a>\n<ul>\n";
		        foreach($itemValue as $subItemKey => $subItemValue)
		        	echo "<li><a href=\"$subItemValue\">$subItemKey</a></li>\n";
		      	echo "</ul>\n";
		      }
		      echo "</li>\n";
		    }
		echo "</ul>\n</nav>\n";
		echo "<br>";
	}

    /**
     * a function to show the hottest items
     * @param  string $showTitle title of the sidebar
     * @param  array $showItems array of item's infomation
     * array could contain another key => value array
     */
	public static function sideshow($showTitle,$showItems){
		echo "<div class=\"sidebar-items\">
		  <h5 class=\"title\">$showTitle</h5>";
		  foreach ($showItems as $itemKey => $itemValue) {
		  	$itemUrl = SharIt::app()->createUrl('product/single-item.php', array('pid'=>$itemValue[id]));
		  	$picUrl = SharHTML::imgUrl("$itemValue[picture_name]");
		    echo '<div class="sitem">';
		      echo '<div class="onethree-left">';
		        // echo "<a href=\"$itemValue[id]\"><img src=\"SharHTML::imgUrl(\"$value[picture_name])\" alt=\"\" class=\"img-responsive\"></a>";
		      echo "<a href=\"$itemUrl\"><img src=\"$picUrl\" alt=\"\" class=\"img-responsive\"></a>";
		      echo "</div>";
		      echo '<div class="onethree-right">';
		        // echo "<a href=\"$itemValue[id]\">$itemValue[name]</a>";
		      echo "<a href=\"$itemUrl\">$itemValue[name]</a>";
		        echo "<p>Total Hits: <b>$itemValue[view_number]</b></p>";
		        echo "<p class=\"bold\">£$itemValue[price]</p>";
		      echo '</div>';
		      echo '<div class="clearfix"></div>';
		    echo '</div>';
		}
		echo '</div>';
	}

	/**
	 * Generate Url
	 * @param  mixed $url  input url, relative path (for SHARIT_URL_APP)
	 * @param  array $para 	get parameters in a array. 
	 * @return string       absolut path
	 */
	public static function imgUrl($imageName){
		$url = SHARIT_URL_APP.SHARIT_PATH_IMG.$imageName;
		return $url;
	}


	/**
     * print page numbers
     * @param  integer  $current  current page number
     * @param  integer  $total  total page number
     * @param  string $connection  a url created by createUrl
     * @param  string $pageph page  placeholder
     * @return String         the paging
     */
	public static function paging($current,$total,$connection,$pageph='[:page]',$offset=2){
		echo '<div class="paging">';
		//previous page
		if($current>1){
			echo '<a href="'.str_replace($pageph,$current-1,$connection).'">Previous</a>';
		}

		if($current>$offset){
			echo '<a href="'.str_replace($pageph,1,$connection).'">First Page</a>';
		}

		$startIndex = max($current-$offset,1);
		if($startIndex!=1){
			echo '<span class="dots">…</span>';
		}
		for ($i=$startIndex; $i < $current; $i++) { 
			echo '<a href="'.str_replace($pageph,$i,$connection).'">'.$i.'</a>';
		}

		echo '<span class="current">'.$current.'</span>';

		$endIndex = min($current+$offset,$total);
		for ($i=$current+1; $i <= $endIndex; $i++) { 
			echo '<a href="'.str_replace($pageph,$i,$connection).'">'.$i.'</a>';
		}
		
		if($endIndex!=$total){
			echo '<span class="dots">…</span>';
		}

		if($current<$total-$offset){
			echo '<a href="'.str_replace($pageph,$total,$connection).'">Last Page</a>';
		}

		if($current<$total){
			echo '<a href="'.str_replace($pageph,$current+1,$connection).'">Next</a>';
		}

		echo "<span>total pages: $total</span>";
		echo "</div>";
	}
	

}