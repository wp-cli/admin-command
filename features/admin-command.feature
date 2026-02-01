Feature: Open /wp-admin/ in a browser

  Scenario: Admin command outputs URL when SSH connection detected
    Given a WP install

    When I try `wp admin`
    Then the return code should be 0
    And STDOUT should contain:
      """
      http://
      """

  Scenario: Admin command works with custom site URL
    Given a WP install
    And I run `wp option update siteurl 'http://example.com'`
    And I run `wp option update home 'http://example.com'`

    When I try `wp admin`
    Then the return code should be 0
    And STDOUT should contain:
      """
      http://example.com/wp-admin/
      """
