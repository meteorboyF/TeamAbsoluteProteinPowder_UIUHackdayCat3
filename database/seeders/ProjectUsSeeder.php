<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Status;
use App\Models\VaultItem;
use App\Models\XpLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProjectUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Couple 1: Alex & Sam
        $alex = User::create([
            'name' => 'Alex Rivera',
            'email' => 'alex@us.app',
            'password' => Hash::make('password'),
            'roles' => ['user'],
        ]);

        $sam = User::create([
            'name' => 'Sam Chen',
            'email' => 'sam@us.app',
            'password' => Hash::make('password'),
            'roles' => ['user'],
        ]);

        // Link them as partners
        $alex->update(['partner_id' => $sam->id]);
        $sam->update(['partner_id' => $alex->id]);

        // Create Couple 2: Jordan & Taylor
        $jordan = User::create([
            'name' => 'Jordan Blake',
            'email' => 'jordan@us.app',
            'password' => Hash::make('password'),
            'roles' => ['user'],
        ]);

        $taylor = User::create([
            'name' => 'Taylor Morgan',
            'email' => 'taylor@us.app',
            'password' => Hash::make('password'),
            'roles' => ['user'],
        ]);

        $jordan->update(['partner_id' => $taylor->id]);
        $taylor->update(['partner_id' => $jordan->id]);

        // Add XP logs for Alex & Sam (high XP couple)
        $this->seedXpLogs($alex->id, 1200); // Level 6: Soulmates
        $this->seedXpLogs($sam->id, 1100);  // Level 5: Partners

        // Add XP logs for Jordan & Taylor (new couple)
        $this->seedXpLogs($jordan->id, 150); // Level 2: Acquaintances
        $this->seedXpLogs($taylor->id, 120); // Level 2: Acquaintances

        // Add statuses
        Status::create([
            'user_id' => $alex->id,
            'type' => 'online',
            'is_active' => true,
        ]);

        Status::create([
            'user_id' => $sam->id,
            'type' => 'ghost',
            'expires_at' => Carbon::now()->addHours(2),
            'is_active' => true,
        ]);

        // Add vault items
        VaultItem::create([
            'user_id' => $alex->id,
            'type' => 'note',
            'file_path' => 'vault/sample_note.txt',
            'unlock_at' => null, // Unlocked
            'is_hidden' => true,
        ]);

        VaultItem::create([
            'user_id' => $sam->id,
            'type' => 'photo',
            'file_path' => 'vault/sample_photo.jpg',
            'unlock_at' => Carbon::now()->addDays(7), // Locked for 7 days
            'is_hidden' => true,
        ]);

        $this->command->info('✅ Project US seed data created successfully!');
        $this->command->info('📧 Test Accounts:');
        $this->command->info('   alex@us.app / password (Level 6)');
        $this->command->info('   sam@us.app / password (Level 5, Ghost Mode)');
        $this->command->info('   jordan@us.app / password (Level 2)');
        $this->command->info('   taylor@us.app / password (Level 2)');
    }

    /**
     * Seed XP logs to reach target XP
     */
    private function seedXpLogs(mixed $userId, int $targetXp): void
    {
        $actions = [
            'daily_check_in' => 50,
            'resolved_conflict' => 100,
            'vault_upload' => 25,
            'ghost_mode_respect' => 30,
            'week_streak' => 200,
        ];

        $currentXp = 0;
        while ($currentXp < $targetXp) {
            $action = array_rand($actions);
            $amount = $actions[$action];

            if ($currentXp + $amount > $targetXp) {
                $amount = $targetXp - $currentXp;
            }

            XpLog::create([
                'user_id' => $userId,
                'action' => $action,
                'xp_amount' => $amount,
            ]);

            $currentXp += $amount;
        }
    }
}
