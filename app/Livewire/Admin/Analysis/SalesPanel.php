<?php

namespace App\Livewire\Admin\Analysis;

use App\Analysis\SalesAnalysisService;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SalesPanel extends Component
{
    public $selectedPeriod = 'today';
    public $fromDate = '';
    public $toDate = '';
    public $analytics = [];

    public function mount(SalesAnalysisService $service)
    {
        $this->fromDate = Verta::instance(Carbon::today()->subDays(3))->format('Y/n/j');
        $this->toDate = Verta::now()->format('Y/n/j');
        $this->loadAnalytics($service);
    }

    public function updatedFromDate($value)
    {
        if ($this->selectedPeriod === 'custom') {
            $this->loadAnalytics(app(SalesAnalysisService::class));
        }
    }

    public function updatedToDate($value)
    {
        if ($this->selectedPeriod === 'custom') {
            $this->loadAnalytics(app(SalesAnalysisService::class));
        }
    }

    public function updatedSelectedPeriod(SalesAnalysisService $service)
    {
        $this->loadAnalytics($service);
    }



    protected function loadAnalytics(SalesAnalysisService $service): void
    {
        $this->analytics = $service->getSalesReport(
            $this->selectedPeriod,
            $this->fromDate,
            $this->toDate
        );
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.analysis.sales-panel');
    }
}
