<?php

/**
 * 利用 GD 動態生成登入驗證的圖片
 *
 * 鑒於每個GD版本出來的效果有一定的差別，請使用附件中的GD.dll，或者選用GD 2.0以上的版本
 *
 * 目前該類庫主要用於登入時生成附帶驗證碼圖片的功能，存儲驗證碼有 Cookies 和 Session 兩種，
 * 生成的圖片支援 PNG / JPG 等，還有可以設定驗證碼的長度，英文字元和數字混合等。
 *
 * @作者         Hessian(solarischan@21cn.com)
 * @版本         1.0
 * @版權所有     Hessian / NETiS
 * @使用授權     GPL（請各位保留Comment）
 * @特別鳴謝     waff（提供了非常特別輸出方式）
 * @開始         2003-11-05
 * @瀏覽         公開
 *
 * 更新記錄
 *
 * ver 1.0 2003-11-05
 * 一個用於生成驗證碼圖片的類庫已經初步完成。
 *
 */
class GenAuth
{

	/**
	 * 判斷是否使用 Session。
	 *
	 * @變量類型  布爾值
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    true / false
	 */
	var $UseSession = true;

	/**
	 * 瀏覽 Session 的 Handle。
	 *
	 * @變量類型  字元串
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      內部
	 * @可選值    無
	 */
	var $_SessionNum = "";

	/**
	 * 驗證碼的長度。
	 *
	 * @變量類型  數字
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    10進制的純數字
	 */
	var $CodeLength = 4;

	/**
	 * 生成的驗證碼是否帶有英文字元。
	 *
	 * @變量類型  布爾值
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    true / false
	 */
	var $CodeWithChar = true;

	/**
	 * 生成圖片的類型。
	 *
	 * @變量類型  字元串
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    PNG / JPEG / WBMP / XBM
	 */
	var $ImageType = "PNG";

	/**
	 * 生成圖片的寬度。
	 *
	 * @變量類型  10進制數字
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    10進制的純數字
	 */
	var $ImageWidth = 80;

	/**
	 * 生成圖片的高度。
	 *
	 * @變量類型  10進制數字
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    10進制的純數字
	 */
	var $ImageHeight = 30;

	/**
	 * 生成後的驗證碼。
	 *
	 * @變量類型  字元串
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    無
	 */
	var $AuthResult = "";

	/**
	 * 圖片中驗證碼的顏色。
	 *
	 * @變量類型  數組
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    順序為 R，G，B, 例如：HTML顏色為 '000033' / array(0,0,51)
	 */
	var $FontColor = array(0, 0, 0);

	/**
	 * 圖片的背景色。
	 *
	 * @變量類型  數組
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    順序為 R，G，B, 例如：HTML顏色為'000033' / array(0,0,51)
	 */
	var $BGColor = array(255, 255, 255);

	/**
	 * 設定背景是否需要透明（注意：只有 PNG 格式支援，如果使用 JPG 格式的話，必須禁止該選項）。
	 *
	 * @變量類型  布爾值
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    true / false
	 */
	var $Transparent = false;

	/**
	 * 設定是否生成帶噪點的背景。
	 *
	 * @變量類型  布爾值
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    true / false
	 */
	var $NoiseBG = true;

	/**
	 * 設定生成噪點的字元。
	 *
	 * @變量類型  字元串
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    任意
	 */
	var $NoiseChar = "*";

	/**
	 * 設定生成多少個噪點字元。
	 *
	 * @變量類型  10進制的純數字
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    0 - 無限
	 */
	var $TotalNoiseChar = 50;

	/**
	 * 驗證碼在圖片中的左邊距。
	 *
	 * @變量類型  10進制數字
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @可選值    10進制的純數字，範圍：0 - 100
	 */
	var $JpegQuality = 50;

	/**
	 * GenAuth 的構造函數
	 *
	 * 詳細說明
	 * @形參
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @返回值    無
	 * @throws
	 */
	function GenAuth()
	{
	} // 結束 GenAuth 的構造函數


	/**
	 * 直接顯示圖片
	 *
	 * 詳細說明
	 * @形參      字元串      $ImageType   設定顯示圖片的格式
	 *            10進制數字  $ImageWidth  設定顯示圖片的高度
	 *            10進制數字  $ImageHeight 設定顯示圖片的寬度
	 * @開始      1.0
	 * @最後修改  1.0
	 * @瀏覽      公開
	 * @返回值    無
	 * @throws
	 */
	function Show( $ImageType = "", $ImageWidth = "", $ImageHeight = "" )
	{

		// 生成驗證碼
		if( $this->CodeWithChar ):
			for( $i = 0; $i < $this->CodeLength; $i++ ){
				$this->AuthResult .= dechex( rand( 1, 15 ) );
			}	
				$_SESSION['vcode']=$this->AuthResult;
		else:
			for( $i = 0; $i < $this->CodeLength; $i++ ){
				$this->AuthResult .= rand( 1, 9 );
			}	
				$_SESSION['vcode']=$this->AuthResult;
		endif;
		// 檢查有沒有設定圖片的輸出格式，如果沒有，則使用類庫的預設值作為最終結果。
		if ( $ImageType == "" )
			$ImageType = $this->ImageType;

		// 檢查有沒有設定圖片的輸出寬度，如果沒有，則使用類庫的預設值作為最終結果。
		if ( $ImageWidth == "" )
			$ImageWidth = $this->ImageWidth;

		// 檢查有沒有設定圖片的輸出高度，如果沒有，則使用類庫的預設值作為最終結果。
		if ( $ImageHeight == "" )
			$ImageHeight = $this->ImageHeight;

		// 建立圖片流
		$im = imagecreate( $ImageWidth, $ImageHeight );

		// 取得背景色
		list ($bgR, $bgG, $bgB) = $this->BGColor;

		// 設定背景色
		$background_color = imagecolorallocate( $im, $bgR, $bgG, $bgB );

		// 取得文字顏色
		list ($fgR, $fgG, $fgB) = $this->FontColor;

		// 設定字型顏色
		$font_color = imagecolorallocate( $im, $fgR, $fgG, $fgB );

		// 檢查是否需要將背景色透明
		if ( $this->Transparent ) {
			ImageColorTransparent( $im, $background_color );
		}

		if( $this->NoiseBG )
		{
//			ImageRectangle($im, 0, 0, $ImageHeight - 1, $ImageWidth - 1, $background_color);//先成一黑色的矩形把圖片包圍

			//下面該生成雪花背景了，其實就是在圖片上生成一些符號
			for ( $i = 1; $i <= $this->TotalNoiseChar; $i++ )
				imageString( $im, 1, mt_rand( 1, $ImageWidth ), mt_rand( 1, $ImageHeight ), $this->NoiseChar, imageColorAllocate( $im, mt_rand( 200, 255 ), mt_rand( 200,255 ), mt_rand( 200,255 ) ) );
		}

		// 為了區別於背景，這裡的顏色不超過200，上面的不小於200
		for ( $i = 0; $i < strlen( $this->AuthResult ); $i++ ){
			imageString( $im, mt_rand(3,5), $i*$ImageWidth/strlen( $this->AuthResult )+mt_rand(1,5), mt_rand(1, $ImageHeight/2), $this->AuthResult[$i], imageColorAllocate( $im, mt_rand(0, 100), mt_rand(0, 150), mt_rand(0, 200) ) );
		}

		// 檢查輸出格式
		if ( $ImageType == "PNG" ) {
			header( "Content-type: image/png" );
			imagepng( $im );
		}

		// 檢查輸出格式
		if ( $ImageType == "JPEG" ) {
			header( "Content-type: image/jpeg" );
			imagejpeg( $im, "", $this->JpegQuality );
		}
		
		// 釋放圖片流
		imagedestroy( $im );

	} // 結束 Show 函數

} // 結束類庫

?>
