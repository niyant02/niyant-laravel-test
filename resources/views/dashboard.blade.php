<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex py-12">
        <div class="w-1/3 sm:px-6 lg:pl-24">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="">
                        <ul>
                            <li class="mb-3 lg:mb-1 pb-1.5 border-b-2">
                                <a class="px-2 -mx-2 py-1 transition duration-200 ease-in-out relative block hover:translate-x-2px hover:text-gray-900 text-gray-600 font-medium
                                @if (\Request::route()->getName() == "dashboard") text-2xl @endif" href="{{route('dashboard')}}">
                                    <span class="rounded absolute inset-0 bg-teal-200 opacity-0"></span>
                                    <span class="relative">API Token</span></a>
                            </li>
                            <li class="mb-3 lg:mb-1 pb-1.5 border-b-2">
                                <a class="px-2 -mx-2 py-1 transition duration-200 ease-in-out relative block hover:translate-x-2px hover:text-gray-900 text-gray-600 font-medium
                                @if (\Request::route()->getName() == "dashboard.image") text-2xl @endif"
                                    href="{{route('dashboard.image')}}">
                                    <span class="rounded absolute inset-0 bg-teal-200 opacity-0"></span>
                                    <span class="relative">Uploaded Images</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="w-2/3 sm:px-6 lg:pr-24">
            @if (\Request::route()->getName() === "dashboard")
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="p-6 bg-white border-b border-gray-200" method="post" action="{{ route('token.create') }}">
                    @method('post')
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="token_name">
                            Token Name
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="token_name" name="token_name" type="text" placeholder="token">
                    </div>
                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="Submit">
                            Submit
                        </button>
                    </div>
                </form>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr>
                                <th class="w-1/2 px-4 py-2 text-left">Token</th>
                                <th class="w-1/4 px-4 py-2 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($user->tokens->count() > 0)
                            @foreach ($user->tokens as $token)
                            <tr>
                                <td class="border px-4 py-2">{{ $token->name }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('token.delete', ['id' => $token->id]) }}" method="post">
                                        @method('post')
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 border bg-grey-900 rounded hover:text-gray-900">revoke</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="border px-4 py-2 text-center" colspan="2">No data found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @elseif(\Request::route()->getName() === "dashboard.image")
            @if ($user->images->count() > 0)
            <div class="grid grid-flow-col grid-cols-3 grid-rows-3 gap-4">
                @foreach ($user->images as $image)
                <div class="px-4">
                    <img src="https://www.creative-tim.com/learning-lab/tailwind-starter-kit/img/team-1-800x800.jpg"
                        alt="..." class="shadow rounded max-w-full h-auto align-middle border-none" />
                </div>
                @endforeach
            </div>
            @else
            <div class="p-6 bg-white border-b border-gray-200">
                <p>No image Uploaded</p>
            </div>
            @endif
            @endif
        </div>
    </div>
</x-app-layout>
