
<div>
    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center space-x-2">
        <i class="fa fa-chart-bar text-indigo-600 text-3xl"></i>
        <span class="text-3xl font-semibold">Dashboard</span>
    </h3>
    <dl class="mt-5 grid grid-cols-1 gap-2 sm:grid-cols-3">
      <div class="p-2 border-t-2 border-red-600 bg-white shadow rounded-lg overflow-hidden ">
        <dt class="text-sm font-medium text-gray-500 truncate">
         UNREAD REQUEST
        </dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">
          {{ $countUnread }}
        </dd>
      </div>
      <div class="p-2 border-t-2 border-red-600 bg-white shadow rounded-lg overflow-hidden ">
        <dt class="text-sm font-medium text-gray-500 truncate">
          PENDING REQUEST
        </dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">
          {{ $countPending }}
        </dd>
      </div>
  
   
      <div class="p-2 border-t-2 border-red-600 bg-white shadow rounded-lg overflow-hidden ">
        <dt class="text-sm font-medium text-gray-500 truncate">
            PAYMENT TO REVIEW
        </dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">
          {{ $countToReview }}
        </dd>
      </div>
    </dl>
  </div>
  
