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
 * Result
 * 31.08.2012 13:46
 */
namespace MOC\Core\Depending;
use MOC\Api;
use MOC\Core\Changelog;
use MOC\Generic\Device\Core;

/**
 *
 */
class Result implements Core {
	/**
	 * Get Changelog
	 *
	 * @static
	 * @return Changelog
	 */
	public static function InterfaceChangelog() {
		return Api::Core()->Changelog();
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
	 * Get Singleton/Instance
	 *
	 * @return \MOC\Core\Depending\Result
	 */
	public static function InterfaceInstance() {
		return new Result();
	}

	private $Install = array();
	private $Update = array();
	private $Available = array();
	private $UpdateOptional = array();
	private $InstallOptional = array();

	/**
	 * @param Package|null $Package
	 *
	 * @return Package[]
	 */
	public function Install( Package $Package = null ) {
		if( $Package !== null ) {
			$this->Install[$Package->GetFQN()] = $Package;
		} return $this->Install;
	}

	/**
	 * @param Package|null $Package
	 *
	 * @return Package[]
	 */
	public function InstallOptional( Package $Package = null ) {
		if( $Package !== null ) {
			$this->InstallOptional[$Package->GetFQN()] = $Package;
		} return $this->InstallOptional;
	}

	/**
	 * @param Package|null $Package
	 *
	 * @return Package[]
	 */
	public function Update( Package $Package = null ) {
		if( $Package !== null ) {
			$this->Update[$Package->GetFQN()] = $Package;
		} return $this->Update;
	}

	/**
	 * @param Package|null $Package
	 *
	 * @return Package[]
	 */
	public function UpdateOptional( Package $Package = null ) {
		if( $Package !== null ) {
			$this->UpdateOptional[$Package->GetFQN()] = $Package;
		} return $this->UpdateOptional;
	}

	/**
	 * @param Package|null $Package
	 *
	 * @return Package[]
	 */
	public function Available( Package $Package = null ) {
		if( $Package !== null ) {
			$this->Available[$Package->GetFQN()] = $Package;
		} return $this->Available;
	}
}
