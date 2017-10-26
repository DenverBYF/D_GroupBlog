<?php

namespace App\Console\Commands;

use App\Group;
use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BlogRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:run {username} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

	protected $username,$email,$password;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
		$this->username = $this->argument('username');
		$this->email = $this->argument('email');
		$this->password = $this->argument('password');
		if($this->create_user()){
			if(Group::all()->count() == 0){
				Group::create([
					'email' => $this->email,
				]);
			}
			try {
				$admin_role = Role::create(['name' => 'admin']);
				$editor_role = Role::create(['name'=>'editor']);
				Permission::create(['name' => 'admin']);
				Permission::create(['name'=>'editor']);
				$admin_role->givePermissionTo(['admin','editor']);
				$editor_role->givePermissionTo('editor');
			} catch (RoleAlreadyExists $e) {

			}
		}
		$user = User::where('email','=',$this->email)->first();
		$user->assignRole('admin');
		$this->info("Admin $this->username creat success. ");
    }
    private function create_user()
	{
		try {
			$user = new User();
			$user->name = $this->username;
			$user->email = $this->email;
			$user->password = bcrypt($this->password);
			$user->save();
		} catch (Exception $e) {
			$this->error($e);
		}
		return TRUE;
	}
}
