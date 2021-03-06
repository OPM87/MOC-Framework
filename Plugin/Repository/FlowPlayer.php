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
 * FlowPlayer
 * 10.06.2013 13:12
 */
namespace MOC\Plugin\Repository;
use MOC\Api;
use MOC\Plugin\Gateway\VideoPlayer;

/**
 *
 */
class FlowPlayer extends VideoPlayer {

	/**
	 * @return bool
	 */
	public function PluginCapable() {
		return in_array(
			Api::Module()->Drive()->File()->Open( $this->VideoSource() )->GetExtension(),
			array( 'flv', 'mp4', 'mov', 'm4v', 'f4v', 'mp3' )
		);
	}

	public function PluginLoader() {
		$this->PluginJavaScript(
			Api::Module()->Drive()->File()->Open( __DIR__.'/FlowPlayer/3rdParty/flowplayer-3.2.12.min.js' )
		);
	}

	public function EmbedPlayer() {

		static $PlayerId;
		$PlayerId++;

		$B = Api::Module()->Drive()->Directory()->Open( __DIR__.'/FlowPlayer/3rdParty/' );
		$C = Api::Module()->Drive()->Directory()->Open( Api::Core()->Drive()->Directory()->DirectoryCurrent() );

		$Script = '<a id="FlowPlayer'.$PlayerId.'" href="'.$this->VideoSource().'" style="display: block; width: '.$this->VideoWidth().'px; height:'.$this->VideoHeight().'px;"></a>'.
		'<script type="text/javascript">'.
			"flowplayer( 'FlowPlayer".$PlayerId."', '".$B->GetLocationRelative( $C ).'/flowplayer-3.2.16.swf'."', ".
			"{".
				"plugins: { ".
					"audio: { ".
						"url: '".$B->GetLocationRelative( $C )."/plugin/flowplayer.audio-3.2.10.swf'".
					"}".
				"}".
			"});".
		'</script>';

		print $Script;

	}

}
