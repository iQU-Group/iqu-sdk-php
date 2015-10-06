# Mobilize Pilot SDK PHP

Mobilize Pilot SDK allows to send event-based tracking data to the mobilize tracking servers.
At least the event Heartbeat should be implemented for every request and should fire at least every 30 seconds as long as the users are active.

This documentation is not finished yet, please have a look to the unit test in tests/ and to the source itself to find the available events (src/Event/).

## Implementation Example

```php
// event transport container
$transportContainer = new \Iqu\Sdk\Transport_Container();
/**
 * the curl transport is used for sending the events to the tracking
 * server
 **/
$curlTransport = new \Iqu\Sdk\Transport\Curl();
// The file transport is a backup if the remote tracking servers are not reachable
$fileTransport = new \Iqu\Sdk\Transport\File("/var/spool/mobilize-pilot/failed-events/");
/**
 * you can specify if a transport will be always used or just if the previous
 * added transports fails
 */
$fileTransport->setSendAlways(true);

// add the curl transport as first transport
$transportContainer->add($curlTransport);
// add the file transport as second transport (will be used if curl fails and setSendAlways(false))
$transportContainer->add($fileTransport);

// the identifiers container contains all known and available user ids
$identifiers = new \Iqu\Sdk\Event_Identifiers();
// sets the facebook user id
$identifiers->setFacebookUserId($facebookUserId);
// sets a custom user id, e.g. if you create your own user ids
$identifiers->setCustomUserId($customUserId);

/**
 * create the event container which holds all events before sending
 * ApiKey and SecretKey are required, you get them from https://pilot.mobilizemygame.com.
 */
$eventContainer = new \Iqu\Sdk\Event_Container($apiKey, $secretKey);
// add an heartbeat event
$eventContainer->add(new \Iqu\Sdk\Event\Heartbeat($this->identifiers));
// sends the events to the tracking servers
$transportContainer->send($eventContainer);
```