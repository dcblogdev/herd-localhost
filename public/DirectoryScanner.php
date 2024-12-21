<?php

declare(strict_types=1);

class DirectoryScanner
{
    protected string $basePath;
    protected array $excludedFolders = [];

    public function __construct(string $basePath, array $excludedFolders = [])
    {
        $this->basePath = realpath($basePath);
        $this->excludedFolders = $excludedFolders;
    }

    public function getProjects(): array
    {
        return array_filter(scandir($this->basePath), function (string $item) {
            return $this->isValidDirectory($item);
        });
    }

    public function getSubProjects(string $project): array
    {
        $projectPath = $this->basePath . '/' . $project;

        return array_filter(scandir($projectPath), function (string $item) use ($projectPath) {
            return is_dir($projectPath . '/' . $item) && $item !== '.' && $item !== '..';
        });
    }

    protected function isValidDirectory(string $item): bool
    {
        return is_dir($this->basePath . '/' . $item) && $item !== '.' && $item !== '..' && !in_array($item, $this->excludedFolders);
    }
}