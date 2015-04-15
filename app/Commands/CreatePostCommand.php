<?php namespace App\Commands;

use App\Commands\Command;

class CreatePostCommand extends Command {
    /**
     * @var
     */



    /**
     * @var
     */
    public  $userId;
    /**
     * @var
     */
    public  $request;

    /**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($request,$userId)
	{
		//

        $this->userId = $userId;
        $this->request = $request;
    }

}
