# HTU API Project

This is a Todo List SPA web application. This app contains an API to respond to AJAX requests. 

## Endpoints:
Below you can find the available endpoints which you can use for the API. The namespace is /htu_api.

GET '/' - tests the api if working. 
- Fetches nothing. It just returns an empty body. 
- Request Argument: None. 
- Returns: An object as per the below:
{
    "success": boolean,
    "message_code": string,
    "body": array
}
- Errors: None. 

GET '/items' - return all the checklist items in the database. 
- Fetches collection of items. 
- Request Arguemnt: None. 
- Returns: An object as per the below:
{
    "success": boolean,
    "message_code": string,
    "body": [
        "items": [object],
        "items_count": integer
    ]
}
- Errors: 400 - if no item was found.

POST '/items' - new checklist item
- It creates new checklist item and add it to the DB. 
- Request Arguemnt: JSON data:{"name": string} 
- Returns: An object as per the below:
{
    "success": boolean,
    "message_code": string,
    "body": []
}
- Errors: 400 - if item was not created.

PUT '/items' - update completed status. 
- update the completed status of an item to the DB.
- Request Arguemnt: JSON data:{"id": integer, "completed": boolean} 
- Returns: An object as per the below:
{
    "success": boolean,
    "message_code": string,
    "body": []
}
- Errors: 400 - if item was not updated.

DELETE '/items' - delete an item. 
- Delete checklist item from the DB.
- Request Arguemnt: JSON data:{"id": integer} 
- Returns: An object as per the below:
{
    "success": boolean,
    "message_code": string,
    "body": []
}
- Errors: 400 - if item was not deleted.

## Status Codes:
- succefull_response: this status for testing api.
- no_items_found: no item was found in the GET /items.
- empty_json_response: for sending empty json data.
- item_name_not_available: for sending json data without name. 
- new_item_added: when new item is added. 
- item_id_not_available: for sending json data without id.
- item_compleation_status_not_available: for sending json data without completed parameter.
- item_updated: when completed value is updated.
- item_deleted: when item was deleted. 