<?php
declare(strict_types=1);

namespace Filesystem;

/**
 * Class Filesystem
 * @package Filesystem
 */
class Filesystem implements FilesystemInterface
{
    /**
     * Creates a directory within a $parent directory with the specified name and return its path without trailing slash
     *
     * @param string $parent Parent directory name
     * @param string $name Directory name
     *
     * @return string
     */
    public function createDirectory(string $parent, string $name): string
    {
        if (!file_exists($parent . '/' . $name)) {
            //create the directory - if not possible, throw an exeption
            if (!mkdir($parent . '/' . $name) && !is_dir($parent . '/' . $name)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $parent . '/' . $name));
            }
        }
        
        return $parent . '/' . $name;
    }

    /**
     * Create a file with the $fileName in the $directory
     *
     * @param string $directory Directory path
     * @param string $fileName File name
     *
     * @return string
     */
    public function createFile(string $directory, string $fileName): string
    {
        touch($directory . '/' . $fileName);

        return $directory . '/' . $fileName;
    }

    /**
     * Write the $content to the $file
     *
     * @param string $filePath
     * @param string $content
     *
     * @throws \Exception
     */
    public function writeToFile(string $filePath, string $content): void
    {
        if (false === file_put_contents($filePath, $content)) {
            throw new \Exception('Count not write to file: ' . $filePath);
        }
    }

    /**
     * Read the file content and return it
     *
     * @param string $filePath
     *
     * @return string
     * @throws \Exception
     */
    public function readFromFile(string $filePath): string
    {
        $content = file_get_contents($filePath);

        if ($content === false) {
            throw new \Exception('Count not read from file: ' . $filePath);
        }

        return $content;
    }
}
