<x-user-layout>
    <div class="relative min-h-screen overflow-hidden">
        <x-shape-blue class="z-0 absolute top-0 right-0 h-1/4 md:h-1/2 w-auto"/>
        <x-shape-red class="z-0 absolute bottom-0 left-0 h-1/6 md:h-1/4 w-auto"/>
        <div class="z-10 absolute w-full min-h-screen flex flex-col justify-center items-center gap-8">
            <x-lineawesome-vote-yea-solid class="w-1/4 h-1/4 md:w-1/6 md:h-1/6 xl:w-1/12 xl:h-1/12"/>
            <h1 class="poppins-bold text-3xl md:text-5xl lg:text-6xl text-center">Thanks for Voting!</h1>
            <p class="text-md md:text-xl text-center">Every vote makes a difference!<br>Thank you for contributing to the outcome.</p>
            <div class="text-sm md:text-md lg:text-lg text-center mt-12">
                <p>you will be returned to the main page in <strong><span>5</span> seconds</strong></p>
            </div>
        </div>
    </div>
</x-user-layout>