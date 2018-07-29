<?php

namespace SDN3Q\Request\Projects;

use MintWare\JOM\ObjectMapper;
use SDN3Q\Model\Project;
use SDN3Q\Request\BaseRequest;

/*
/api/v2/projects


POST /api/v2/projects Create a new Project
/api/v2/projects/{ProjectId}
DELETE /api/v2/projects/{ProjectId} Delete a Project by Id
GET /api/v2/projects/{ProjectId} Return Project
PUT /api/v2/projects/{ProjectId}
*/


class Projects extends BaseRequest {
	protected static $endpoint = 'projects';

	/**
	 * Return a collection of available Projects
	 * @return array
	 * @throws \Exception
	 */
	public static function getProjects() {
		$projects = [];
		try {
			$mapper   = new ObjectMapper();
			$response = self::getResponse();
			$data     = json_decode( $response, true );
			if ( count( $data['Projects'] ) > 0 ) {
				foreach ( $data['Projects'] as $dataProject ) {
					$projects[] = $mapper->mapJson( json_encode( $dataProject ), Project::class );
				}
			}
		} catch ( \Exception $e ) {
			throw $e;
		}

		return $projects;
	}

	/**
	 * Return Project
	 *
	 * @param int $projectId
	 *
	 * @return Project|null
	 * @throws \Exception
	 */
	public static function getProject( int $projectId ) {
		$project = null;
		try {
			$mapper         = new ObjectMapper();
			parent::$subUrl = $projectId;

			$response = self::getResponse();
			$project = $mapper->mapJson( $response, Project::class );
		} catch ( \Exception $e ) {
			throw $e;
		}


		return $project;
	}

	/**
	 * Create a new Project
	 *
	 * @param string $label
	 * @param int    $streamTypeId
	 *
	 * @return int
	 * @throws \Exception
	 */
	public static function postProject( string $label, int $streamTypeId ) {
		self::$method = 'post';
		try {

			self::$requestParm['label']        = $label;
			self::$requestParm['streamTypeId'] = $streamTypeId;

			$response = self::getResponse();
		} catch ( \Exception $e ) {
			throw $e;
		}
		$json      = json_decode( $response, true );
		$projectId = $json['ProjectId'];
		return $projectId;

	}

	/**
	 * Delete a Project by Id
	 *
	 * @param int $projectId
	 *
	 * @throws \SDN3Q\Exception\NotImplemented
	 */
	public static function deleteProject( int $projectId ) {
		self::$method = 'delete';
		try {
			parent::$subUrl = $projectId;
			$response = self::getResponse();
		} catch ( \Exception $e ) {
			throw $e;
		}
		return true;
	}

	/**
	 * Change proprties of Project
	 *
	 * @param int    $projectId
	 * @param string $label
	 * @param bool   $tokenSecurity
	 *
	 * @throws \SDN3Q\Exception\NotImplemented
	 */
	public static function putProject( int $projectId, string $label, bool $tokenSecurity = false ) {
		self::$method = 'put';
		try {
			parent::$subUrl = $projectId;

			self::$requestParm['label']        = $label;
			self::$requestParm['TokenSecurity'] = $tokenSecurity;
			$response = self::getResponse();
		} catch ( \Exception $e ) {
			throw $e;
		}
		return true;
	}
}


