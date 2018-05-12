<?php
declare(strict_types=1);

namespace Filesystem;

/**
 * Interface FilesystemInterface
 * @package Run
 */
interface FilesystemInterface
{
    /**
     * Creates a directory within a $parent directory with the specified name and return its path without trailing slash
     *
     * @param string $parent Parent directory name
     * @param string $name Directory name
     *
     * @return string
     */
    public function createDirectory(string $parent, string $name): string;

    /**
     * Create a file with the $fileName in the $directory
     *
     * @param string $directory Directory path
     * @param string $fileName File name
     *
     * @return string
     */
    public function createFile(string $directory, string $fileName): string;

    /**
     * Write the $content to the $file
     *
     * @param string $filePath
     * @param string $content
     */
    public function writeToFile(string $filePath, string $content): void;

    /**
     * Read the file content and return it
     *
     * @param string $filePath
     *
     * @return string
     */
    public function readFromFile(string $filePath): string;
}
