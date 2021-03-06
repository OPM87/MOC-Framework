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
 * GLSGermany
 * 30.01.2013 10:25
 */
namespace MOC\Module\Network\ParcelTracker\Carrier;
use MOC\Api;
use MOC\Generic\Device\Module;
use MOC\Module\Network\ParcelTracker\Carrier;
use MOC\Module\Network\ParcelTracker\Parcel;

/**
 *
 */
class GLSGermany extends Carrier implements Module {
	/**
	 * Get Singleton/Instance
	 *
	 * @static
	 * @return object
	 */
	public static function InterfaceInstance() {
		return new GLSGermany();
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
	 * Get Changelog
	 *
	 * @static
	 * @return \MOC\Core\Changelog
	 */
	public static function InterfaceChangelog() {
		return Api::Core()->Changelog()->Create( __CLASS__ );
	}

	/**
	 * @param int $TrackingNumber
	 *
	 * @return Parcel
	 */
	function GetStatus( $TrackingNumber ) {

		$this->SetTarget( 'https://gls-group.eu/app/service/open/rest/DE/de/rstt001?match='.$TrackingNumber );

		$HistoryList = json_decode( $this->GetData( true ) )->tuStatus[0]->history;

		// Set Target back to original location
		$this->SetTarget( 'https://gls-group.eu/DE/de/paketverfolgung?match='.$TrackingNumber );

		$Parcel = new Parcel( $TrackingNumber, $this->GetTarget() );

		foreach( (array)$HistoryList as $History ) {
			$TrackingLocation = $History->address->city .', '.$History->address->countryDescription;
			$TrackingTimestamp = strtotime( preg_replace( '![^\d\.\: ]!is', '', $History->date.' '.$History->time ) );
			$TrackingMessage = $History->evtDscr;

			$Parcel->AddStatus( $TrackingTimestamp, $TrackingMessage, $TrackingLocation );
		}

		return $Parcel;

	}
}
