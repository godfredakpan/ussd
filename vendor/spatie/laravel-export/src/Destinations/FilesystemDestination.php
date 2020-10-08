<?php

namespace Spatie\Export\Destinations;

use Spatie\Export\Destination;
use Illuminate\Contracts\Filesystem\Filesystem;

class FilesystemDestination implements Destination
{
    /** @var \Illuminate\Contracts\Filesystem */
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function clean()
    {
        $this->filesystem->delete($this->filesystem->files());

        foreach ($this->filesystem->directories() as $directory) {
            $this->filesystem->deleteDirectory($directory);
        }
    }

    public function write(string $path, string $contents)
    {
        $this->filesystem->put($path, $contents);
    }
}
