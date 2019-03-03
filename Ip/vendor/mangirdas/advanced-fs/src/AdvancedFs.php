<?php

class AdvancedFs
{

    /**
     * Create path if it does not exist (recursive)
     * @param string $path
     */
    public static function createPath($path)
    {
        $path = self::removeTrailingSlash($path);
        if (!is_dir($path)) {
            self::createPath(dirname($path));
            mkdir($path);
        }
    }

    /**
     * Remove path and everything in it. The same as `rm -rf`
     * @param string $path
     * @throws \AdvancedFs\WriteException
     */
    public static function removePath($path)
    {
        $path = self::removeTrailingSlash($path);
        if (!file_exists($path)) {
            return;
        }

        if (!is_writable($path)) {
            throw new AdvancedFs\WriteException($path);
        }

        if (is_dir($path)) {
            if ($handle = opendir($path)) {
                while (false !== ($item = readdir($handle))) {
                    if ($item == ".." || $item == ".") {
                        continue;
                    }

                    self::removePath($path . '/' . $item);
                }
                closedir($handle);
            }

            rmdir($path);
        } else {
            unlink($path);
        }
    }

    /**
     * Remove everything from dir (make it empty).
     * @var string $path
     * @throws \AdvancedFs\PathNotFoundException
     */
    public static function cleanPath($path)
    {
        $path = self::removeTrailingSlash($path);
        if (!is_dir($path)) {
            throw new \AdvancedFs\PathNotFoundException($path);
        }

        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file == ".." || $file == ".") {
                    continue;
                }
                self::removePath($path . '/' . $file);
            }
            closedir($handle);
        }
    }

    /**
     * Copy all content from the source into the destination directory. But not the source folder it self.
     * @param string $source
     * @param string $destination
     * @throws \Exception
     */
    public static function copyPathContent($source, $destination)
    {
        $source = self::removeTrailingSlash($source);
        $destination = self::removeTrailingSlash($destination);

        if (!is_dir($source)) {
            throw new \AdvancedFs\PathNotFoundException($source);
        }
        if (!is_dir($destination)) {
            throw new \AdvancedFs\PathNotFoundException($destination);
        }
        if (!is_writable($destination)) {
            throw new \AdvancedFs\WriteException($destination);
        }

        $handle = opendir($source);
        while ($file = readdir($handle)) {
            if ($file == "." || $file == "..") {
                continue;
            }
            if (is_dir($source . "/" . $file)) {
                mkdir($destination . "/" . $file);
                self::copyPathContent($source . "/" . $file, $destination . "/" . $file);
            } else {
                copy($source . "/" . $file, $destination . "/" . $file);
            }
        }
        closedir($handle);
    }

    private static function removeTrailingSlash($path)
    {
        return preg_replace('{/$}', '', $path);
    }
}
