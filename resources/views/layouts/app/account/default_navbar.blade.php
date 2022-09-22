<li class="flex w-full justify-between {{ isset($active) && $active == 'dashboard' ? 'text-indigo-700' : 'text-gray-600' }} cursor-pointer items-center mb-6">
    <a href="{{ route('account.dashboard') }}" class="flex items-center">
        @if(isset($mobile) && $mobile == true)
            <span class="xl:text-base md:text-2xl text-base ml-2">Dashboard</span>
        @else
            <span class="text-sm">Dashboard</span>
        @endif
    </a>
</li>
<li class="flex w-full justify-between {{ isset($active) && $active == 'my-donations' ? 'text-indigo-700' : 'text-gray-600' }} cursor-pointer items-center mb-6">
    <a href="{{ route('account.my-donations') }}" class="flex items-center">
        @if(isset($mobile) && $mobile == true)
            <span class="xl:text-base md:text-2xl text-base ml-2">My Donations</span>
        @else
            <span class="text-sm">My Donations</span>
        @endif
    </a>
    <div class="py-1 px-3 bg-indigo-700 rounded text-white flex items-center justify-center text-xs">{{ \App\Helpers\StaticData::myTotalDonation() }}</div>
</li>
<li class="flex w-full justify-between {{ isset($active) && $active == 'my-campaigns' ? 'text-indigo-700' : 'text-gray-600' }} cursor-pointer items-center mb-6">
    <a href="{{ route('account.my-campaigns') }}" class="flex items-center">
        @if(isset($mobile) && $mobile == true)
            <span class="xl:text-base md:text-2xl text-base ml-2">My Campaigns</span>
        @else
            <span class="text-sm">My Campaigns</span>
        @endif
    </a>
    <div class="py-1 px-3 bg-indigo-700 rounded text-white flex items-center justify-center text-xs">{{ \App\Helpers\StaticData::myTotalCampaign() }}</div>
</li>
<li class="flex w-full justify-between text-gray-600 cursor-pointer items-center mb-6">
    <a href="{{ route('auth.logout') }}" class="flex items-center">
        @if(isset($mobile) && $mobile == true)
            <span class="xl:text-base md:text-2xl text-base ml-2">Logout</span>
        @else
            <span class="text-sm">Logout</span>
        @endif
    </a>
</li>
{{--<li class="flex w-full justify-between text-gray-600 hover:text-indigo-700 cursor-pointer items-center mb-6">
    <a href="javascript:void(0)" class="flex items-center">
        <span class="text-sm">Products</span>
    </a>
    <div class="py-1 px-3 bg-indigo-700 rounded text-white flex items-center justify-center text-xs">8</div>
</li>
<li class="flex w-full justify-between text-gray-600 hover:text-indigo-700 cursor-pointer items-center mb-6">
    <a href="javascript:void(0)" class="flex items-center">
        <span class="text-sm">Performance</span>
    </a>
</li>
<li class="flex w-full justify-between text-gray-600 hover:text-indigo-700 cursor-pointer items-center mb-6">
    <a href="javascript:void(0)" class="flex items-center">
        <span class="text-sm">Deliverables</span>
    </a>
</li>
<li class="flex w-full justify-between text-gray-600 hover:text-indigo-700 cursor-pointer items-center mb-6">
    <a href="javascript:void(0)" class="flex items-center">
        <span class="text-sm">Invoices</span>
    </a>
    <div class="py-1 px-3 bg-indigo-700 rounded text-white flex items-center justify-center text-xs">25</div>
</li>
<li class="flex w-full justify-between text-gray-600 hover:text-indigo-700 cursor-pointer items-center mb-6">
    <a href="javascript:void(0)" class="flex items-center">
        <span class="text-sm">Inventory</span>
    </a>
</li>
<li class="flex w-full justify-between text-gray-600 hover:text-indigo-700 cursor-pointer items-center">
    <a href="javascript:void(0)" class="flex items-center">
        <span class="text-sm">Settings</span>
    </a>
</li>--}}
