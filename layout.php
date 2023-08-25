<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?=$title;?></title>
</head>
<body>
    <!-- Main navigation container -->
<nav
  class="flex-no-wrap relative flex w-full items-center justify-between py-2 shadow-md shadow-black/5 bg-neutral-950 shadow-black/10 lg:flex-wrap lg:justify-start lg:py-4"
  data-te-navbar-ref>
  <div class="flex w-full flex-wrap items-center justify-between px-3">

    <!-- Collapsible navigation container -->
    <div
      class="flex flex-grow flex-col lg:items-center md:items-center lg:flex-row md:flex-row lg:!flex lg:basis-auto"
      id="navbarSupportedContent1"
      data-te-collapse-item>
      <!-- Logo -->
      <a
        class="mb-4 ml-2 mr-5 mt-3 flex items-center text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 text-neutral-200 hover:text-neutral-400 focus:text-neutral-400 lg:mb-0 lg:mt-0"
        href="#">
        <img
          src="asset/GMS.png"
          style="height: 50px"
          alt="TE Logo"
          loading="lazy" />
      </a>
      <!-- Left navigation links -->
      <div class=" lg:flex md:flex">
      <ul
        class="list-style-none mr-auto flex flex-col pl-0 md:flex-row lg:flex-row"
        data-te-navbar-nav-ref>
        <li class="mb-4 lg:mb-0 lg:pr-2 md:mb-0 md:pr-2" data-te-nav-item-ref>
          <!-- Dashboard link -->
          <a
            class="text-neutral-300 transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none text-neutral-200 hover:text-neutral-300 focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 [&.active]:text-zinc-400"
            href="dashboard.php"
            data-te-nav-link-ref
            >Dashboard</a
          >
        </li>
        <!-- Team link -->
        <li class="mb-4 lg:mb-0 lg:pr-2 md:mb-0 md:pr-2" data-te-nav-item-ref>
          <a
            class="text-neutral-300 transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none text-neutral-200 hover:text-neutral-300 focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 [&.active]:text-neutral-400"
            href="team.php"
            data-te-nav-link-ref
            >Team</a
          >
        </li>
        <!-- Volunteers link -->
        <li class="mb-4 lg:mb-0 lg:pr-2 md:mb-0 md:pr-2" data-te-nav-item-ref>
          <a
            class="text-neutral-300 transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none text-neutral-200 hover:text-neutral-300 focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 [&.active]:text-neutral-400"
            href="volunteer.php"
            data-te-nav-link-ref
            >Volunteers</a
          >
        </li>
        <!-- Evaluation link -->
        <li class="mb-4 lg:mb-0 lg:pr-2 md:mb-0 md:pr-2" data-te-nav-item-ref>
          <a
            class="text-neutral-300 transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none text-neutral-200 hover:text-neutral-300 focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 [&.active]:text-neutral-400"
            href="evaluation.php"
            data-te-nav-link-ref
            >Evaluation</a
          >
        </li>
      </ul>
    </div>
    </div>
    <div class="relative flex items-center text-neutral-300 mx-8"> 
    <ul
        class="list-style-none mr-auto flex flex-col pl-0 md:flex-row lg:flex-row"
        data-te-navbar-nav-ref>
        <li class="mb-4 lg:mb-0 lg:pr-2 md:mb-0 md:pr-2" data-te-nav-item-ref>
          <!-- Dashboard link -->
          <a
            class="text-neutral-300 transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none text-neutral-200 hover:text-neutral-300 focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 [&.active]:text-zinc-400"
            href="Controller.php/logout"
            data-te-nav-link-ref
            >Logout</a
          >
        </li>
    </ul>
    </div>
  </div>
</nav>
</body>
</html>