<?php

namespace App\Http\Controllers\Messages;

use App\Http\Requests\Pattern\Create;
use App\Http\Requests\Pattern\Update;
use App\Models\Messages\Pattern;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PatternsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Pattern::class);

        $patterns = Pattern::query()->with(['user'])->paginate(15);

        return view('patterns.index', compact('patterns'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorize('create', Pattern::class);

        return view('patterns.create');
    }

    /**
     * @param Create $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Create $request)
    {
        $this->authorize('create', Pattern::class);

        Pattern::create(array_merge($request->validated(), [
            'user_id' => Auth::id()
        ]));

        return redirect(route('patterns.index'));
    }

    /**
     * @param Pattern $pattern
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Pattern $pattern)
    {
        $this->authorize('view', Pattern::class);

        return view('patterns.show', compact('pattern'));
    }

    /**
     * @param Pattern $pattern
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Pattern $pattern)
    {
        $this->authorize('update', Pattern::class);

        return view('patterns.edit', compact('pattern'));
    }

    /**
     * @param Update $request
     * @param Pattern $pattern
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Update $request, Pattern $pattern)
    {
        $this->authorize('update', Pattern::class);

        $pattern->update($request->validated());

        return redirect(route('patterns.index'));
    }

    /**
     * @param Pattern $pattern
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Pattern $pattern)
    {
        $this->authorize('delete', Pattern::class);

        $pattern->delete();

        return response()->noContent();
    }
}
