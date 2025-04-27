use App\Http\Controllers\InvestmentOptController;

Route::get('/investments', [InvestInvestmentOptController::class, 'index'])