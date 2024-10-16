<?php
namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

trait HandlesCustomExceptions
{
    /**
     * Handle exceptions and return a custom response.
     *
     * @param Exception $e
     * @param string $redirectRoute
     * @param array $input
     * @return RedirectResponse
     */
    public function handleException(Exception $e, string $redirectRoute, array $input = []): RedirectResponse
    {
        // Log the exception details
        Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);

        // Redirect back with input and a generic error message
        return redirect()->route($redirectRoute)->withInput($input)->withErrors([
            'error' => 'An error occurred while processing your request. Please try again later.',
        ]);
    }
}
