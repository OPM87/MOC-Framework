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
 * Constant
 * 16.01.2013 09:34
 */
namespace MOC\Module\Database;
/**
 *
 */
class Constant {

	/**
	 * Debug-Switch
	 */

	const DEBUG_HTML = 1;

	/**
	 * Parameter-Key Wildcard
	 */

	const PARAM_KEY_UNDEFINED = '?';

	/**
	 * Simple Parameter-Type
	 */

	const PARAM_TYPE_NONE = 1;
	const PARAM_TYPE_STRING = 2;
	const PARAM_TYPE_INTEGER = 3;

	/**
	 * Complex Parameter-Type
	 */

	const PARAM_TYPE_DATETIME = 4;
	// Array('String1','String..') => 'String1', 'String..'
	const PARAM_TYPE_STRING_LIST = 21;

	/**
	 * Result
	 */

	const RESULT_AS_OBJECT = -1;
	const RESULT_AS_RESOURCE = 0;
	const RESULT_AS_ARRAY = 1;
	const RESULT_AS_ARRAY_ASSOC = 2;

}
