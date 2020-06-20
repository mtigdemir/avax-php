<?php

namespace Tests\AVA\Endpoints;

class KeyStoreTest extends BaseEndpointTest
{
    public function testCreateUser()
    {
        $this->mockApiCall('success.json');
        $status = $this->apiClient->keyStore->createUser('test-user', 'test-password');
        $this->assertTrue($status);

        $this->assertEquals('keystore.createUser', $this->getLastRequest()->method);
    }

    public function testDeleteUser()
    {
        $this->mockApiCall('success.json');
        $status = $this->apiClient->keyStore->deleteUser('test-user', 'test-password');
        $this->assertTrue($status);

        $this->assertEquals('keystore.deleteUser', $this->getLastRequest()->method);
    }

    public function testListUsers()
    {
        $this->mockApiCall('keyStore.listUsers.json');

        $result = $this->apiClient->keyStore->listUsers();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertContains('bob', $result);

        $this->assertEquals('keystore.listUsers', $this->getLastRequest()->method);
    }

    public function testExportUser()
    {
        $this->mockApiCall('keyStore.exportUser.json');

        $result = $this->apiClient->keyStore->exportUser("export-user", "export-password");
        $this->assertNotEmpty($result);

        $this->assertEquals('keystore.exportUser', $this->getLastRequest()->method);
    }

    public function testImportUser()
    {
        $this->mockApiCall('success.json');

        $result = $this->apiClient->keyStore->importUser("import-username", "import-password", "exportedstringhash");
        $this->assertTrue($result);

        $this->assertEquals('keystore.importUser', $this->getLastRequest()->method);
    }
}
