<?php


namespace SDN3Q\Model;
use MintWare\JOM\JsonField;


class ChannelInput extends BaseModel {


	/**
	 * Type of Channel input
	 *
	 * @var string
	 * @JsonField(name="StreamInType", type="string")
	 */
	public $streamInType;


	/**
	 * Connection Details for Input
	 *
	 * @var \SDN3Q\Model\StreamInConnection
	 * @JsonField(name="StreamInConnection", type="\SDN3Q\Model\StreamInConnection")
	 */
	public $streamInConnection;

}