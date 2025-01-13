<?php

class Building {
    private $name;
    private $level;
    private $cost;
    private $buildTime;

    public function __construct($name, $level = 1) {
        $this->name = $name;
        $this->level = $level;
        $this->setBuildingProperties();
    }

    private function setBuildingProperties() {
        // Example properties based on building type
        switch ($this->name) {
            case 'Metal Mine':
                $this->cost = ['metal' => 60 * $this->level, 'crystal' => 15 * $this->level];
                $this->buildTime = 30 * $this->level; // in seconds
                break;
            case 'Crystal Mine':
                $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
                break;
            // Add more buildings as needed
            case 'Quantum Reactor'
            $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
            case 'Stellar Forge':
    $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
            case 'Galactic Observatory':
    $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
'Warp Drive Facility':
    $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
'Terraforming Station';
            $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
'Defense Matrix':
    $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
'Resource Synthesizer':
    $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
'Cryo Storage':
    $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
'Interstellar Dock':
    $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            break;
'Nano Assembly Plant':
    $this->cost = ['metal' => 48 * $this->level, 'crystal' => 24 * $this->level];
                $this->buildTime = 40 * $this->level; // in seconds
            default:
                throw new Exception("Building type not recognized.");
        }
    }

    public function upgrade() {
        $this->level++;
        $this->setBuildingProperties(); // Update properties for new level
    }

    public function getCost() {
        return $this->cost;
    }

    public function getLevel() {
        return $this->level;
    }

    public function getName() {
        return $this->name;
    }

    public function getBuildTime() {
        return $this->buildTime;
    }
}

// Example usage
$metalMine = new Building('Metal Mine');
echo "Building: " . $metalMine->getName() . "\n";
echo "Level: " . $metalMine->getLevel() . "\n";
echo "Cost: " . json_encode($metalMine->getCost()) . "\n";
echo "Build Time: " . $metalMine->getBuildTime() . " seconds\n";

$metalMine->upgrade();
echo "Upgraded Level: " . $metalMine->getLevel() . "\n";
echo "New Cost: " . json_encode($metalMine->getCost()) . "\n";
echo "New Build Time: " . $metalMine->getBuildTime() . " seconds\n";
?>
