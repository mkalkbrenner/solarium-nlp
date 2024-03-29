<?php

namespace SolariumNlp;

/**
 * This class makes the client easier to use (shorter class name) and adds
 * a library version check.
 */
class Nlp
{
    /**
     * Version number of the SolariumNlplibrary.
     *
     * The version is built up in this format: major.minor.mini
     *
     * A major release is used for significant release with architectural
     * changes and changes that might break backwards compatibility
     *
     * A minor release adds and enhances features, and might also contain
     * bugfixes. It should be backwards compatible, or the incompatibilities
     * should be clearly documented with the release.
     *
     * A mini release only contains bugfixes to existing features and is always
     * backwards compatible.
     *
     * If you develop your application to a specific Solarium version it is best
     * to check for that exact major and minor version, leaving the mini version
     * open to allow for upgrades in case of bugfixes.
     *
     * @see checkExact()
     * @see checkMinimal()
     *
     * @var string
     */
    const VERSION = '0.1.4';

    /**
     * Check for an exact version.
     *
     * This method can check for all three versioning levels, but they are
     * optional. If you only care for major and minor versions you can use
     * something like '1.0' as input. Or '1' if you only want to check a major
     * version.
     *
     * For each level that is checked the input has to be exactly the same as
     * the actual version. Some examples:
     *
     * The if the version is 1.2.3 the following checks would return true:
     * - 1 (only major version is checked)
     * - 1.2 (only major and minor version are checked)
     * - 1.2.3 (full version is checked)
     *
     * These values will return false:
     * - 1.0 (lower)
     * - 1.2.4 (higher)
     *
     *
     * A string compare is used instead of version_compare because
     * version_compare returns false for a compare of 1.0.0 with 1.0
     *
     * @param string $version
     *
     * @return bool
     */
    public static function checkExact(string $version): bool
    {
        return 0 === strpos(self::VERSION, $version);
    }

    /**
     * Check for a minimal version.
     *
     * This method can check for all three versioning levels, but they are
     * optional. If you only care for major and minor versions you can use
     * something like '1.0' as input. Or '1' if you only want to check a major
     * version.
     *
     * For each level that is checked the actual value needs to be the same or
     * higher. Some examples:
     *
     * The if the version is 1.2.3 the following checks would return true:
     * - 1.2.3 (the same)
     * - 1 (the actual version is higher)
     *
     * These values will return false:
     * - 2 (the actual version is lower)
     * - 1.3 (the actual version is lower)
     *
     * @param string $version
     *
     * @return bool
     */
    public static function checkMinimal(string $version): bool
    {
        return version_compare(self::VERSION, $version, '>=');
    }

  /**
   * Returns the real path to an openNLP demo model.
   *
   * @param string $name
   * @param string $version
   *
   * @return string
   *
   * @throws \InvalidArgumentException
   */
    public function getOpenNlpDemoModelPath(string $name, string $version = 'combined'): string
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'opennlp' . DIRECTORY_SEPARATOR . 'models-' . $version . DIRECTORY_SEPARATOR . $name;
        if (!file_exists($path) || !is_readable($path)) {
          throw new \InvalidArgumentException(sprintf("File %s does not exist or isn't readable", $path));
        }
        return $path;
    }
}
