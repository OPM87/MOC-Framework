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
 * View
 * 18.02.2013 15:01
 */
namespace MOC\Generic\Device\Widget;
use MOC\Core\Template\Variable;
use MOC\Generic\Common;
/**
 *
 */
abstract class View implements Common {
	/**
	 * Create Output
	 *
	 * @return string
	 */
	abstract public function Build();

	/** @var Variable[] $VariableList */
	private $VariableList = array();

	/**
	 * Set ${Identifier}
	 *
	 * @param string $Identifier
	 * @param string $Value
	 */
	final public function setVariable( $Identifier, $Value ) {
		$this->VariableList[$Identifier] = Variable::InterfaceInstance()->SetData( $Identifier, $Value );
	}

	/**
	 * Get \MOC\Core\Template\Variable
	 *
	 * @param string $Identifier
	 *
	 * @return \MOC\Core\Template\Variable
	 */
	final public function getVariable( $Identifier ) {
		if( isset( $this->VariableList[$Identifier] ) ) {
			return $this->VariableList[$Identifier];
		} else {
			return Variable::InterfaceInstance()->SetData( $Identifier, null );
		}
	}

	/**
	 * @return string
	 */
	function __toString() {
		return $this->Build();
	}
}
