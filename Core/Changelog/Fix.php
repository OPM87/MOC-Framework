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
 * Fix
 * 18.02.2013 08:38
 */
namespace MOC\Core\Changelog;
use MOC\Api;
use MOC\Generic\Device\Core;

/**
 *
 */
class Fix implements Core {
	/**
	 * Get Dependencies
	 *
	 * @static
	 * @return \MOC\Core\Depending
	 * @noinspection PhpAbstractStaticMethodInspection
	 */
	public static function InterfaceDepending() {
		return Api::Core()->Depending();
	}

	/**
	 * Get Singleton/Instance
	 *
	 * @static
	 * @return \MOC\Core\Changelog\Fix
	 * @noinspection PhpAbstractStaticMethodInspection
	 */
	public static function InterfaceInstance() {
		return new Fix();
	}

	/**
	 * Get Changelog
	 *
	 * @static
	 * @return \MOC\Core\Changelog
	 * @noinspection PhpAbstractStaticMethodInspection
	 */
	public static function InterfaceChangelog() {
		return Api::Core()->Changelog()->Create( __CLASS__ )
			->Fix()->DocFix( '18.02.2013 10:58', 'Add description to HotFix()' )
			->Fix()->DocFix( '18.02.2013 11:23', 'Add description to BugFix()' )
			->Fix()->DocFix( '18.02.2013 12:02', 'Add description DocFix()' )
			->Build()->Clearance( '18.02.2013 13:17', 'Alpha' )
		;
	}

	/**
	 * A hotfix is ​​a very important (urgent) fix, but contains no new features.
	 *
	 * @param $Timestamp
	 * @param $Message
	 *
	 * @return \MOC\Core\Changelog
	 */
	public function HotFix( $Timestamp, $Message ) {
		$Record = Record::InterfaceInstance();
		$Record->Timestamp( $Timestamp );
		$Record->Method( __METHOD__ );
		$Record->Message( $Message );
		return Api::Core()->Changelog()->Append( $Record );
	}

	/**
	 * A bugfix corrects errors in the program source code, which could otherwise cause malfunctions.
	 *
	 * @param $Timestamp
	 * @param $Message
	 *
	 * @return \MOC\Core\Changelog
	 */
	public function BugFix( $Timestamp, $Message ) {
		$Record = Record::InterfaceInstance();
		$Record->Timestamp( $Timestamp );
		$Record->Method( __METHOD__ );
		$Record->Message( $Message );
		return Api::Core()->Changelog()->Append( $Record );
	}

	/**
	 * A docfix corrects errors in the documentation code block
	 *
	 * @param $Timestamp
	 * @param $Message
	 *
	 * @return \MOC\Core\Changelog
	 */
	public function DocFix( $Timestamp, $Message ) {
		$Record = Record::InterfaceInstance();
		$Record->Timestamp( $Timestamp );
		$Record->Method( __METHOD__ );
		$Record->Message( $Message );
		return Api::Core()->Changelog()->Append( $Record );
	}
}