<?php

class InstallationTest extends BrowserKitTest
{
    /** @test */
    public function it_installs()
    {
        exec('./tests/integration/test_installation.sh', $output, $return_code);
//        dd($output);
        self::assertEquals($return_code, 0);
    }
}
