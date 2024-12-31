<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', Team::class);

        // Coming soon.
    }

    public function create(): View
    {
        Gate::authorize('create', Team::class);

        // Coming soon.
    }

    public function store(StoreTeamRequest $request): RedirectResponse
    {
        Gate::authorize('create', Team::class);

        // Coming soon.
    }

    public function changeCurrentTeam(int $teamId)
    {
        Gate::authorize('changeTeam', Team::class);

        $team = auth()->user()->teams()->findOrFail($teamId);

        if (!auth()->user()->belongsToTeam($team)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        // Change team
        auth()->user()->update(['current_team_id' => $team->id]);
        setPermissionsTeamId($team->id);
        auth()->user()->unsetRelation('roles')->unsetRelation('permissions');

        return redirect(route('dashboard'), Response::HTTP_SEE_OTHER);
    }
}
