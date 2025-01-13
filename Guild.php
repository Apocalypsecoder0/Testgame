<?php
class Guild {
    private $guilds = [];

    public function createGuild($name, $leaderId) {
        $this->guilds[$name] = [
            'leader' => $leaderId,
            'members' => [],
        ];
        return "Guild '$name' created.";
    }

    public function joinGuild($name, $memberId) {
        if (isset($this->guilds[$name])) {
            $this->guilds[$name]['members'][] = $memberId;
            return "Member '$memberId' joined guild '$name'.";
        }
        return "Guild '$name' does not exist.";
    }

    public function leaveGuild($name, $memberId) {
        if (isset($this->guilds[$name])) {
            $key = array_search($memberId, $this->guilds[$name]['members']);
            if ($key !== false) {
                unset($this->guilds[$name]['members'][$key]);
                return "Member '$memberId' left guild '$name'.";
            }
            return "Member '$memberId' is not in guild '$name'.";
        }
        return "Guild '$name' does not exist.";
    }

    public function getGuildInfo($name) {
        if (isset($this->guilds[$name])) {
            return $this->guilds[$name];
        }
        return "Guild '$name' does not exist.";
    }
}

// Example usage
$guild = new Guild();
echo $guild->createGuild("Warriors", 1);
echo $guild->joinGuild("Warriors", 2);
echo $guild->leaveGuild("Warriors", 2);
print_r($guild->getGuildInfo("Warriors"));
?>
