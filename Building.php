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

```php
$quantumReactor = new Building('Quantum Reactor');
echo "Building: " . $quantumReactor->getName() . "\n";
echo "Level: " . $quantumReactor->getLevel() . "\n";
echo "Cost: " . json_encode($quantumReactor->getCost()) . "\n";
echo "Build Time: " . $quantumReactor->getBuildTime() . " seconds\n";

$stellarForge = new Building('Stellar Forge');
echo "Building: " . $stellarForge->getName() . "\n";
echo "Level: " . $stellarForge->getLevel() . "\n";
echo "Cost: " . json_encode($stellarForge->getCost()) . "\n";
echo "Build Time: " . $stellarForge->getBuildTime() . " seconds\n";

$galacticObservatory = new Building('Galactic Observatory');
echo "Building: " . $galacticObservatory->getName() . "\n";
echo "Level: " . $galacticObservatory->getLevel() . "\n";
echo "Cost: " . json_encode($galacticObservatory->getCost()) . "\n";
echo "Build Time: " . $galacticObservatory->getBuildTime() . " seconds\n";

$warpDriveFacility = new Building('Warp Drive Facility');
echo "Building: " . $warpDriveFacility->getName() . "\n";
echo "Level: " . $warpDriveFacility->getLevel() . "\n";
echo "Cost: " . json_encode($warpDriveFacility->getCost()) . "\n";
echo "Build Time: " . $warpDriveFacility->getBuildTime() . " seconds\n";

$terraformingStation = new Building('Terraforming Station');
echo "Building: " . $terraformingStation->getName() . "\n";
echo "Level: " . $terraformingStation->getLevel() . "\n";
echo "Cost: " . json_encode($terraformingStation->getCost()) . "\n";
echo "Build Time: " . $terraformingStation->getBuildTime() . " seconds\n";

$defenseMatrix = new Building('Defense Matrix');
echo "Building: " . $defenseMatrix->getName() . "\n";
echo "Level: " . $defenseMatrix->getLevel() . "\n";
echo "Cost: " . json_encode($defenseMatrix->getCost()) . "\n";
echo "Build Time: " . $defenseMatrix->getBuildTime() . " seconds\n";

$resourceSynthesizer = new Building('Resource Synthesizer');
echo "Building: " . $resourceSynthesizer->getName() . "\n";
echo "Level: " . $resourceSynthesizer->getLevel() . "\n";
echo "Cost: " . json_encode($resourceSynthesizer->getCost()) . "\n";
echo "Build Time: " . $resourceSynthesizer->getBuildTime() . " seconds\n";

$cryoStorage = new Building('Cryo Storage');
echo "Building: " . $cryoStorage->getName() . "\n";
echo "Level: " . $cryoStorage->getLevel() . "\n";
echo "Cost: " . json_encode($cryoStorage->getCost()) . "\n";
echo "Build Time: " . $cryoStorage->getBuildTime() . " seconds\n";

$interstellarDock = new Building('Interstellar Dock');
echo "Building: " . $interstellarDock->getName() . "\n";
echo "Level: " . $interstellarDock->getLevel() . "\n";
echo "Cost: " . json_encode($interstellarDock->getCost()) . "\n";
echo "Build Time: " . $interstellarDock->getBuildTime() . " seconds\n";

$nanoAssemblyPlant = new Building('Nano Assembly Plant');
echo "Building: " . $nanoAssemblyPlant->getName() . "\n";
echo "Level: " . $nanoAssemblyPlant->getLevel() . "\n";
echo "Cost: " . json_encode($nanoAssemblyPlant->getCost()) . "\n";
echo "Build Time: " . $nanoAssemblyPlant->getBuildTime() . " seconds\n";
?>
```
?>
