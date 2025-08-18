<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {email : Email del usuario a convertir en admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convierte un usuario en administrador del sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("No se encontró ningún usuario con el email: {$email}");
            return 1;
        }
        
        if ($user->is_admin) {
            $this->info("El usuario {$user->name} ({$email}) ya es administrador.");
            return 0;
        }
        
        $user->update(['is_admin' => true]);
        
        $this->info("✅ El usuario {$user->name} ({$email}) ha sido convertido en administrador exitosamente.");
        
        return 0;
    }
}
