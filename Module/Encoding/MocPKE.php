<?php
/**
 * LICENSE (BSD)
 *
 * Copyright (c) 2012, Gerd Christian Kunze
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
 * MocPKE
 * 26.10.2012 14:53
 */
namespace MOC\Module\Encoding;
use MOC\Api;
use MOC\Generic\Device\Module;
/**
 *
 */
class MocPKE implements Module {

	/**
	 * Get Changelog
	 *
	 * @static
	 * @return \MOC\Core\Changelog
	 * @noinspection PhpAbstractStaticMethodInspection
	 */
	public static function InterfaceChangelog() {
		return Api::Core()->Changelog()->Create(__CLASS__);
	}

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
	 * @return MocPKE
	 * @noinspection PhpAbstractStaticMethodInspection
	 */
	public static function InterfaceInstance() {
		return new MocPKE();
	}

	/**
	 * @param int $Secure
	 *
	 * @return MocPKE\KeyPair
	 */
	public function CreateKeyPair( $Secure = 10 ) {
		$Factory = new MocPKE\KeyFactory();
		return $Factory->KeyPair( $Secure );
	}

	/**
	 * @param            $Payload
	 * @param MocPKE\Key $PublicKeyRecipient
	 * @param MocPKE\Key $PrivateKeySender
	 *
	 * @return MocPKE\Message
	 */
	public function Encode( $Payload, MocPKE\Key $PublicKeyRecipient, MocPKE\Key $PrivateKeySender ) {
		$Factory = new MocPKE\MessageFactory();
		return $Factory->Create( $Payload, $PrivateKeySender, $PublicKeyRecipient );
	}

	/**
	 * @param            $Payload
	 * @param MocPKE\Key $PublicKeySender
	 *
	 * @return bool
	 */
	public function Check( $Payload, MocPKE\Key $PublicKeySender ) {
		$Factory = new MocPKE\MessageFactory();
		return $Factory->Check( $Payload, $PublicKeySender );
	}

	/**
	 * @param MocPKE\Message $Message
	 * @param MocPKE\Key     $PrivateKeyRecipient
	 *
	 * @return bool
	 */
	public function Decode( MocPKE\Message $Message, MocPKE\Key $PrivateKeyRecipient ) {
		$Factory = new MocPKE\MessageFactory();
		return $Factory->Open( $Message, $PrivateKeyRecipient );
	}
}
