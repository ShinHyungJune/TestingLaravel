<?php

namespace Tests\Unit;

use App\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_team_has_a_name()
    {
        // Given
        $team = new Team(['name' => 'Acme']);

        // Then
        $this->assertEquals('Acme', $team->name);
    }

    /** @test */
    public function a_team_can_add_members()
    {
        // Given
        $team = factory(Team::class)->create();

        // When
        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($user);
        $team->add($userTwo);

        // Then
        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_has_a_maximum_size()
    {
        // Given
        $team = factory(Team::class)->create(['size' => 1]);

        // When
        $userOne = factory(User::class)->create();

        $team->add($userOne);

        // Then
        $this->assertEquals(1, $team->count());

        $this->expectException('Exception');

        $userTwo = factory(User::class)->create();
        $team->add($userTwo);
    }

    /** @test */
    public function when_adding_many_members_at_once_you_still_may_not_exceed_the_team_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class, 3)->create();

        $this->expectException('Exception');

        $team->add($users);
    }

    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_can_remove_a_member()
    {
        // Given
        $team = factory(Team::class)->create();
        $users = factory(User::class, 2)->create();

        // When
        $team->add($users);

        $team->remove($users[0]);

        // Then
        $this->assertEquals(1, $team->count());
    }

    /** @test */
    public function a_team_can_remove_more_than_one_member_at_once()
    {
        $team = factory(Team::class)->create(['size' => 3]);
        $users = factory(User::class, 3)->create();

        $team->add($users);

        $team->remove($users->slice(0,2));

        $this->assertEquals(1, $team->count());
    }

    /** @test */
    public function a_team_can_remove_all_member()
    {
        // Given
        $team = factory(Team::class)->create();
        $users = factory(User::class, 2)->create();

        // When
        $team->add($users);

        $team->refresh($users);

        // Then
        $this->assertEquals(0, $team->count());
    }
}
