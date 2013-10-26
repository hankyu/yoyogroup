<?php

/**
 * �Q�� GD �ʺA�ͦ��n�J���Ҫ��Ϥ�
 *
 * ų��C��GD�����X�Ӫ��ĪG���@�w���t�O�A�ШϥΪ��󤤪�GD.dll�A�Ϊ̿��GD 2.0�H�W������
 *
 * �ثe�����w�D�n�Ω�n�J�ɥͦ����a���ҽX�Ϥ����\��A�s�x���ҽX�� Cookies �M Session ��ءA
 * �ͦ����Ϥ��䴩 PNG / JPG ���A�٦��i�H�]�w���ҽX�����סA�^��r���M�Ʀr�V�X���C
 *
 * @�@��         Hessian(solarischan@21cn.com)
 * @����         1.0
 * @���v�Ҧ�     Hessian / NETiS
 * @�ϥα��v     GPL�]�ЦU��O�dComment�^
 * @�S�O����     waff�]���ѤF�D�`�S�O��X�覡�^
 * @�}�l         2003-11-05
 * @�s��         ���}
 *
 * ��s�O��
 *
 * ver 1.0 2003-11-05
 * �@�ӥΩ�ͦ����ҽX�Ϥ������w�w�g��B�����C
 *
 */
class GenAuth
{

	/**
	 * �P�_�O�_�ϥ� Session�C
	 *
	 * @�ܶq����  ������
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    true / false
	 */
	var $UseSession = true;

	/**
	 * �s�� Session �� Handle�C
	 *
	 * @�ܶq����  �r����
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ����
	 * @�i���    �L
	 */
	var $_SessionNum = "";

	/**
	 * ���ҽX�����סC
	 *
	 * @�ܶq����  �Ʀr
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    10�i��¼Ʀr
	 */
	var $CodeLength = 4;

	/**
	 * �ͦ������ҽX�O�_�a���^��r���C
	 *
	 * @�ܶq����  ������
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    true / false
	 */
	var $CodeWithChar = true;

	/**
	 * �ͦ��Ϥ��������C
	 *
	 * @�ܶq����  �r����
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    PNG / JPEG / WBMP / XBM
	 */
	var $ImageType = "PNG";

	/**
	 * �ͦ��Ϥ����e�סC
	 *
	 * @�ܶq����  10�i��Ʀr
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    10�i��¼Ʀr
	 */
	var $ImageWidth = 80;

	/**
	 * �ͦ��Ϥ������סC
	 *
	 * @�ܶq����  10�i��Ʀr
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    10�i��¼Ʀr
	 */
	var $ImageHeight = 30;

	/**
	 * �ͦ��᪺���ҽX�C
	 *
	 * @�ܶq����  �r����
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    �L
	 */
	var $AuthResult = "";

	/**
	 * �Ϥ������ҽX���C��C
	 *
	 * @�ܶq����  �Ʋ�
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    ���Ǭ� R�AG�AB, �Ҧp�GHTML�C�⬰ '000033' / array(0,0,51)
	 */
	var $FontColor = array(0, 0, 0);

	/**
	 * �Ϥ����I����C
	 *
	 * @�ܶq����  �Ʋ�
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    ���Ǭ� R�AG�AB, �Ҧp�GHTML�C�⬰'000033' / array(0,0,51)
	 */
	var $BGColor = array(255, 255, 255);

	/**
	 * �]�w�I���O�_�ݭn�z���]�`�N�G�u�� PNG �榡�䴩�A�p�G�ϥ� JPG �榡���ܡA�����T��ӿﶵ�^�C
	 *
	 * @�ܶq����  ������
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    true / false
	 */
	var $Transparent = false;

	/**
	 * �]�w�O�_�ͦ��a���I���I���C
	 *
	 * @�ܶq����  ������
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    true / false
	 */
	var $NoiseBG = true;

	/**
	 * �]�w�ͦ����I���r���C
	 *
	 * @�ܶq����  �r����
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    ���N
	 */
	var $NoiseChar = "*";

	/**
	 * �]�w�ͦ��h�֭Ӿ��I�r���C
	 *
	 * @�ܶq����  10�i��¼Ʀr
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    0 - �L��
	 */
	var $TotalNoiseChar = 50;

	/**
	 * ���ҽX�b�Ϥ���������Z�C
	 *
	 * @�ܶq����  10�i��Ʀr
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @�i���    10�i��¼Ʀr�A�d��G0 - 100
	 */
	var $JpegQuality = 50;

	/**
	 * GenAuth ���c�y���
	 *
	 * �Բӻ���
	 * @�ΰ�
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @��^��    �L
	 * @throws
	 */
	function GenAuth()
	{
	} // ���� GenAuth ���c�y���


	/**
	 * ������ܹϤ�
	 *
	 * �Բӻ���
	 * @�ΰ�      �r����      $ImageType   �]�w��ܹϤ����榡
	 *            10�i��Ʀr  $ImageWidth  �]�w��ܹϤ�������
	 *            10�i��Ʀr  $ImageHeight �]�w��ܹϤ����e��
	 * @�}�l      1.0
	 * @�̫�ק�  1.0
	 * @�s��      ���}
	 * @��^��    �L
	 * @throws
	 */
	function Show( $ImageType = "", $ImageWidth = "", $ImageHeight = "" )
	{

		// �ͦ����ҽX
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
		// �ˬd���S���]�w�Ϥ�����X�榡�A�p�G�S���A�h�ϥ����w���w�]�ȧ@���̲׵��G�C
		if ( $ImageType == "" )
			$ImageType = $this->ImageType;

		// �ˬd���S���]�w�Ϥ�����X�e�סA�p�G�S���A�h�ϥ����w���w�]�ȧ@���̲׵��G�C
		if ( $ImageWidth == "" )
			$ImageWidth = $this->ImageWidth;

		// �ˬd���S���]�w�Ϥ�����X���סA�p�G�S���A�h�ϥ����w���w�]�ȧ@���̲׵��G�C
		if ( $ImageHeight == "" )
			$ImageHeight = $this->ImageHeight;

		// �إ߹Ϥ��y
		$im = imagecreate( $ImageWidth, $ImageHeight );

		// ���o�I����
		list ($bgR, $bgG, $bgB) = $this->BGColor;

		// �]�w�I����
		$background_color = imagecolorallocate( $im, $bgR, $bgG, $bgB );

		// ���o��r�C��
		list ($fgR, $fgG, $fgB) = $this->FontColor;

		// �]�w�r���C��
		$font_color = imagecolorallocate( $im, $fgR, $fgG, $fgB );

		// �ˬd�O�_�ݭn�N�I����z��
		if ( $this->Transparent ) {
			ImageColorTransparent( $im, $background_color );
		}

		if( $this->NoiseBG )
		{
//			ImageRectangle($im, 0, 0, $ImageHeight - 1, $ImageWidth - 1, $background_color);//�����@�¦⪺�x�Χ�Ϥ��]��

			//�U���ӥͦ�����I���F�A���N�O�b�Ϥ��W�ͦ��@�ǲŸ�
			for ( $i = 1; $i <= $this->TotalNoiseChar; $i++ )
				imageString( $im, 1, mt_rand( 1, $ImageWidth ), mt_rand( 1, $ImageHeight ), $this->NoiseChar, imageColorAllocate( $im, mt_rand( 200, 255 ), mt_rand( 200,255 ), mt_rand( 200,255 ) ) );
		}

		// ���F�ϧO��I���A�o�̪��C�⤣�W�L200�A�W�������p��200
		for ( $i = 0; $i < strlen( $this->AuthResult ); $i++ ){
			imageString( $im, mt_rand(3,5), $i*$ImageWidth/strlen( $this->AuthResult )+mt_rand(1,5), mt_rand(1, $ImageHeight/2), $this->AuthResult[$i], imageColorAllocate( $im, mt_rand(0, 100), mt_rand(0, 150), mt_rand(0, 200) ) );
		}

		// �ˬd��X�榡
		if ( $ImageType == "PNG" ) {
			header( "Content-type: image/png" );
			imagepng( $im );
		}

		// �ˬd��X�榡
		if ( $ImageType == "JPEG" ) {
			header( "Content-type: image/jpeg" );
			imagejpeg( $im, "", $this->JpegQuality );
		}
		
		// ����Ϥ��y
		imagedestroy( $im );

	} // ���� Show ���

} // �������w

?>
