Feature: Get user info
    In order to use Application API interface should be working

    Background:
        Given collection "todo_list" having the following data:
        """
        [
            {"id": 1,"title": "Test 1", "completed": true},
            {"id": 2,"title": "Test 2", "completed": false}
        ]
        """

    Scenario: User that exists
        When call "DELETE" "/api/delete" with resource id "1"
        Then response status should be "200"
        And json response should be:
        """
        Success
        """

    Scenario: User that doesn't exists
        When call "GET" "/api/delete" with resource id "3"
        Then response status should be "404"