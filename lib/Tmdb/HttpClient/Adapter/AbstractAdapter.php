<?php
/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 0.0.1
 */
namespace Tmdb\HttpClient\Adapter;
use Tmdb\Exception\TmdbApiException;
use Tmdb\HttpClient\Request;
use Tmdb\HttpClient\Response;

/**
 * Interface AdapterInterface
 * @package Tmdb\HttpClient
 */
abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * Create the unified exception to throw
     *
     * @param  Request $request
     * @param  Response $response
     * @param \Exception $previous
     * @return TmdbApiException
     */
    protected function createApiException(Request $request, Response $response, \Exception $previous= null)
    {
        $errors = json_decode((string) $response->getBody());

        return new TmdbApiException(
            isset($errors->status_code) ? $errors->status_code : -1,
            isset($errors->status_message) ? $errors->status_message : null,
            $request,
            $response,
            $previous
        );
    }
}
