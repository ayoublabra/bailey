<?php
/**
 * WorkspaceUser
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  DocuSign\eSign
 * @author   Swagger Codegen team <apihelp@docusign.com>
 * @license  The DocuSign PHP Client SDK is licensed under the MIT License.
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * DocuSign REST API
 *
 * The DocuSign REST API provides you with a powerful, convenient, and simple Web services API for interacting with DocuSign.
 *
 * OpenAPI spec version: v2.1
 * Contact: devcenter@docusign.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.21-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace DocuSign\eSign\Model;

use \ArrayAccess;
use DocuSign\eSign\ObjectSerializer;

/**
 * WorkspaceUser Class Doc Comment
 *
 * @category    Class
 * @description A workspaceUser representing the user. This property is only returned in response to user specific GET call.
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team <apihelp@docusign.com>
 * @license     The DocuSign PHP Client SDK is licensed under the MIT License.
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class WorkspaceUser implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'workspaceUser';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'account_id' => '?string',
        'account_name' => '?string',
        'active_since' => '?string',
        'created' => '?string',
        'created_by_id' => '?string',
        'email' => '?string',
        'error_details' => '\DocuSign\eSign\Model\ErrorDetails',
        'invitation_email_blurb' => '?string',
        'invitation_email_subject' => '?string',
        'last_modified' => '?string',
        'last_modified_by_id' => '?string',
        'status' => '?string',
        'type' => '?string',
        'user_id' => '?string',
        'user_name' => '?string',
        'workspace_id' => '?string',
        'workspace_user_base_url' => '?string',
        'workspace_user_id' => '?string',
        'workspace_user_uri' => '?string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'account_id' => null,
        'account_name' => null,
        'active_since' => null,
        'created' => null,
        'created_by_id' => null,
        'email' => null,
        'error_details' => null,
        'invitation_email_blurb' => null,
        'invitation_email_subject' => null,
        'last_modified' => null,
        'last_modified_by_id' => null,
        'status' => null,
        'type' => null,
        'user_id' => null,
        'user_name' => null,
        'workspace_id' => null,
        'workspace_user_base_url' => null,
        'workspace_user_id' => null,
        'workspace_user_uri' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'account_id' => 'accountId',
        'account_name' => 'accountName',
        'active_since' => 'activeSince',
        'created' => 'created',
        'created_by_id' => 'createdById',
        'email' => 'email',
        'error_details' => 'errorDetails',
        'invitation_email_blurb' => 'invitationEmailBlurb',
        'invitation_email_subject' => 'invitationEmailSubject',
        'last_modified' => 'lastModified',
        'last_modified_by_id' => 'lastModifiedById',
        'status' => 'status',
        'type' => 'type',
        'user_id' => 'userId',
        'user_name' => 'userName',
        'workspace_id' => 'workspaceId',
        'workspace_user_base_url' => 'workspaceUserBaseUrl',
        'workspace_user_id' => 'workspaceUserId',
        'workspace_user_uri' => 'workspaceUserUri'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'account_id' => 'setAccountId',
        'account_name' => 'setAccountName',
        'active_since' => 'setActiveSince',
        'created' => 'setCreated',
        'created_by_id' => 'setCreatedById',
        'email' => 'setEmail',
        'error_details' => 'setErrorDetails',
        'invitation_email_blurb' => 'setInvitationEmailBlurb',
        'invitation_email_subject' => 'setInvitationEmailSubject',
        'last_modified' => 'setLastModified',
        'last_modified_by_id' => 'setLastModifiedById',
        'status' => 'setStatus',
        'type' => 'setType',
        'user_id' => 'setUserId',
        'user_name' => 'setUserName',
        'workspace_id' => 'setWorkspaceId',
        'workspace_user_base_url' => 'setWorkspaceUserBaseUrl',
        'workspace_user_id' => 'setWorkspaceUserId',
        'workspace_user_uri' => 'setWorkspaceUserUri'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'account_id' => 'getAccountId',
        'account_name' => 'getAccountName',
        'active_since' => 'getActiveSince',
        'created' => 'getCreated',
        'created_by_id' => 'getCreatedById',
        'email' => 'getEmail',
        'error_details' => 'getErrorDetails',
        'invitation_email_blurb' => 'getInvitationEmailBlurb',
        'invitation_email_subject' => 'getInvitationEmailSubject',
        'last_modified' => 'getLastModified',
        'last_modified_by_id' => 'getLastModifiedById',
        'status' => 'getStatus',
        'type' => 'getType',
        'user_id' => 'getUserId',
        'user_name' => 'getUserName',
        'workspace_id' => 'getWorkspaceId',
        'workspace_user_base_url' => 'getWorkspaceUserBaseUrl',
        'workspace_user_id' => 'getWorkspaceUserId',
        'workspace_user_uri' => 'getWorkspaceUserUri'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['account_id'] = isset($data['account_id']) ? $data['account_id'] : null;
        $this->container['account_name'] = isset($data['account_name']) ? $data['account_name'] : null;
        $this->container['active_since'] = isset($data['active_since']) ? $data['active_since'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['created_by_id'] = isset($data['created_by_id']) ? $data['created_by_id'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['error_details'] = isset($data['error_details']) ? $data['error_details'] : null;
        $this->container['invitation_email_blurb'] = isset($data['invitation_email_blurb']) ? $data['invitation_email_blurb'] : null;
        $this->container['invitation_email_subject'] = isset($data['invitation_email_subject']) ? $data['invitation_email_subject'] : null;
        $this->container['last_modified'] = isset($data['last_modified']) ? $data['last_modified'] : null;
        $this->container['last_modified_by_id'] = isset($data['last_modified_by_id']) ? $data['last_modified_by_id'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['user_id'] = isset($data['user_id']) ? $data['user_id'] : null;
        $this->container['user_name'] = isset($data['user_name']) ? $data['user_name'] : null;
        $this->container['workspace_id'] = isset($data['workspace_id']) ? $data['workspace_id'] : null;
        $this->container['workspace_user_base_url'] = isset($data['workspace_user_base_url']) ? $data['workspace_user_base_url'] : null;
        $this->container['workspace_user_id'] = isset($data['workspace_user_id']) ? $data['workspace_user_id'] : null;
        $this->container['workspace_user_uri'] = isset($data['workspace_user_uri']) ? $data['workspace_user_uri'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets account_id
     *
     * @return ?string
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     *
     * @param ?string $account_id The account ID associated with the envelope.
     *
     * @return $this
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets account_name
     *
     * @return ?string
     */
    public function getAccountName()
    {
        return $this->container['account_name'];
    }

    /**
     * Sets account_name
     *
     * @param ?string $account_name The name of the account that the workspace user belongs to.
     *
     * @return $this
     */
    public function setAccountName($account_name)
    {
        $this->container['account_name'] = $account_name;

        return $this;
    }

    /**
     * Gets active_since
     *
     * @return ?string
     */
    public function getActiveSince()
    {
        return $this->container['active_since'];
    }

    /**
     * Sets active_since
     *
     * @param ?string $active_since 
     *
     * @return $this
     */
    public function setActiveSince($active_since)
    {
        $this->container['active_since'] = $active_since;

        return $this;
    }

    /**
     * Gets created
     *
     * @return ?string
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     *
     * @param ?string $created The UTC DateTime when the workspace user was created.
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets created_by_id
     *
     * @return ?string
     */
    public function getCreatedById()
    {
        return $this->container['created_by_id'];
    }

    /**
     * Sets created_by_id
     *
     * @param ?string $created_by_id 
     *
     * @return $this
     */
    public function setCreatedById($created_by_id)
    {
        $this->container['created_by_id'] = $created_by_id;

        return $this;
    }

    /**
     * Gets email
     *
     * @return ?string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param ?string $email 
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets error_details
     *
     * @return \DocuSign\eSign\Model\ErrorDetails
     */
    public function getErrorDetails()
    {
        return $this->container['error_details'];
    }

    /**
     * Sets error_details
     *
     * @param \DocuSign\eSign\Model\ErrorDetails $error_details This object describes errors that occur. It is only valid for responses and ignored in requests.
     *
     * @return $this
     */
    public function setErrorDetails($error_details)
    {
        $this->container['error_details'] = $error_details;

        return $this;
    }

    /**
     * Gets invitation_email_blurb
     *
     * @return ?string
     */
    public function getInvitationEmailBlurb()
    {
        return $this->container['invitation_email_blurb'];
    }

    /**
     * Sets invitation_email_blurb
     *
     * @param ?string $invitation_email_blurb 
     *
     * @return $this
     */
    public function setInvitationEmailBlurb($invitation_email_blurb)
    {
        $this->container['invitation_email_blurb'] = $invitation_email_blurb;

        return $this;
    }

    /**
     * Gets invitation_email_subject
     *
     * @return ?string
     */
    public function getInvitationEmailSubject()
    {
        return $this->container['invitation_email_subject'];
    }

    /**
     * Sets invitation_email_subject
     *
     * @param ?string $invitation_email_subject 
     *
     * @return $this
     */
    public function setInvitationEmailSubject($invitation_email_subject)
    {
        $this->container['invitation_email_subject'] = $invitation_email_subject;

        return $this;
    }

    /**
     * Gets last_modified
     *
     * @return ?string
     */
    public function getLastModified()
    {
        return $this->container['last_modified'];
    }

    /**
     * Sets last_modified
     *
     * @param ?string $last_modified Utc date and time the comment was last updated (can only be done by creator.)
     *
     * @return $this
     */
    public function setLastModified($last_modified)
    {
        $this->container['last_modified'] = $last_modified;

        return $this;
    }

    /**
     * Gets last_modified_by_id
     *
     * @return ?string
     */
    public function getLastModifiedById()
    {
        return $this->container['last_modified_by_id'];
    }

    /**
     * Sets last_modified_by_id
     *
     * @param ?string $last_modified_by_id 
     *
     * @return $this
     */
    public function setLastModifiedById($last_modified_by_id)
    {
        $this->container['last_modified_by_id'] = $last_modified_by_id;

        return $this;
    }

    /**
     * Gets status
     *
     * @return ?string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param ?string $status Indicates the envelope status. Valid values are:  * sent - The envelope is sent to the recipients.  * created - The envelope is saved as a draft and can be modified and sent later.
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets type
     *
     * @return ?string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param ?string $type Type of the user. Valid values: type_owner, type_participant.
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets user_id
     *
     * @return ?string
     */
    public function getUserId()
    {
        return $this->container['user_id'];
    }

    /**
     * Sets user_id
     *
     * @param ?string $user_id 
     *
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->container['user_id'] = $user_id;

        return $this;
    }

    /**
     * Gets user_name
     *
     * @return ?string
     */
    public function getUserName()
    {
        return $this->container['user_name'];
    }

    /**
     * Sets user_name
     *
     * @param ?string $user_name 
     *
     * @return $this
     */
    public function setUserName($user_name)
    {
        $this->container['user_name'] = $user_name;

        return $this;
    }

    /**
     * Gets workspace_id
     *
     * @return ?string
     */
    public function getWorkspaceId()
    {
        return $this->container['workspace_id'];
    }

    /**
     * Sets workspace_id
     *
     * @param ?string $workspace_id 
     *
     * @return $this
     */
    public function setWorkspaceId($workspace_id)
    {
        $this->container['workspace_id'] = $workspace_id;

        return $this;
    }

    /**
     * Gets workspace_user_base_url
     *
     * @return ?string
     */
    public function getWorkspaceUserBaseUrl()
    {
        return $this->container['workspace_user_base_url'];
    }

    /**
     * Sets workspace_user_base_url
     *
     * @param ?string $workspace_user_base_url The relative URI that may be used to access a workspace user.
     *
     * @return $this
     */
    public function setWorkspaceUserBaseUrl($workspace_user_base_url)
    {
        $this->container['workspace_user_base_url'] = $workspace_user_base_url;

        return $this;
    }

    /**
     * Gets workspace_user_id
     *
     * @return ?string
     */
    public function getWorkspaceUserId()
    {
        return $this->container['workspace_user_id'];
    }

    /**
     * Sets workspace_user_id
     *
     * @param ?string $workspace_user_id 
     *
     * @return $this
     */
    public function setWorkspaceUserId($workspace_user_id)
    {
        $this->container['workspace_user_id'] = $workspace_user_id;

        return $this;
    }

    /**
     * Gets workspace_user_uri
     *
     * @return ?string
     */
    public function getWorkspaceUserUri()
    {
        return $this->container['workspace_user_uri'];
    }

    /**
     * Sets workspace_user_uri
     *
     * @param ?string $workspace_user_uri 
     *
     * @return $this
     */
    public function setWorkspaceUserUri($workspace_user_uri)
    {
        $this->container['workspace_user_uri'] = $workspace_user_uri;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

