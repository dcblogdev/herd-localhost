<?php
require('DirectoryScanner.php');

$exclude = ['localhost'];
$scanner = new DirectoryScanner('../../', $exclude);
$projects = $scanner->getProjects();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Herd Sites</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased dark:bg-gray-800 dark:text-white/50">

<div class="container mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-center text-indigo-700 dark:text-white mb-12">
        Laravel Herd - Parked Sites
    </h1>

    <div class="overflow-x-auto">
        <div class="flex flex-nowrap space-x-6">

            <?php if (count($projects) > 0): ?>
                <?php foreach ($projects as $project):
                    $subProjects = $scanner->getSubProjects($project);
                ?>
                <div class="w-80 flex-shrink-0 shadow-lg rounded-lg p-6 bg-white dark:bg-gray-700 hover:shadow-xl transition-shadow">
                    <h2 class="text-2xl font-semibold text-indigo-700 dark:text-gray-200 mb-4">
                        <?php echo strtoupper(str_replace('-', ' ',$project)); ?>
                    </h2>
                    <ul class="space-y-2">
                        <?php if (count($subProjects) > 0): ?>
                            <?php foreach ($subProjects as $subProject): ?>
                                <li>
                                    <a href="http://<?php echo "$subProject.test"; ?>"
                                       class="text-blue-500 dark:text-yellow-400 hover:underline focus-visible:ring-2 focus-visible:ring-indigo-400">
                                        <?php echo "$subProject.test"; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-gray-500 dark:text-gray-400 italic">No projects found</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="w-full text-center py-10">
                    <p class="text-gray-500 dark:text-gray-400 text-lg">No parked sites found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>