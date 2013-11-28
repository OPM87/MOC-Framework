<?php
/**
 * LICENSE (BSD)
 *
 * Copyright (c) 2013, Gerd Christian Kunze
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *  * Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *
 *  * Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 *  * Neither the name of Gerd Christian Kunze nor the names of the
 *    contributors may be used to endorse or promote products derived from
 *    this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * Phone
 * 28.11.2013 12:51
 */
namespace MOC\Module\Encoding\QRCode;
use MOC\Api;
use MOC\Generic\Device\Module;
use MOC\Module\Drive\File;
use MOC\Module\Encoding\QRCode;

/**
 *
 */
class Phone implements Module {

	/**
	 * Get Singleton/Instance
	 *
	 * @static
	 * @return Phone
	 */
	public static function InterfaceInstance() {
		return new Phone();
	}

	/**
	 * Get Changelog
	 *
	 * @static
	 * @return \MOC\Core\Changelog
	 */
	public static function InterfaceChangelog() {
		return Api::Core()->Changelog()->Create( __CLASS__ );
	}

	/**
	 * Get Dependencies
	 *
	 * @static
	 * @return \MOC\Core\Depending
	 */
	public static function InterfaceDepending() {
		return Api::Core()->Depending();
	}

	/**
	 * @param string $PhoneNumber
	 * @param File   $File      (PNG)
	 * @param string $ErrorCorrectionLevel
	 * @param int    $PointSize [1..10]
	 * @param int    $PointMargin
	 *
	 * @return \MOC\Module\Drive\File
	 */
	public function CallApplication( $PhoneNumber, File $File, $ErrorCorrectionLevel = QRCode::ERROR_CORRECTION_LEVEL_LOW, $PointSize = 4, $PointMargin = 2 ) {
		$Text = 'tel:'.$PhoneNumber;
		return Api::Module()->Encoding()->QRCode()->EncodeText( $Text, $File, $ErrorCorrectionLevel, $PointSize, $PointMargin );
	}

	/**
	 * @param string $PhoneNumber
	 * @param File   $File      (PNG)
	 * @param string $ErrorCorrectionLevel
	 * @param int    $PointSize [1..10]
	 * @param int    $PointMargin
	 *
	 * @return \MOC\Module\Drive\File
	 */
	public function SmsApplication( $PhoneNumber, File $File, $ErrorCorrectionLevel = QRCode::ERROR_CORRECTION_LEVEL_LOW, $PointSize = 4, $PointMargin = 2 ) {
		$Text = 'sms:'.$PhoneNumber;
		return Api::Module()->Encoding()->QRCode()->EncodeText( $Text, $File, $ErrorCorrectionLevel, $PointSize, $PointMargin );
	}
}
