class Party {
    private $members = [];

    public function addMember($member) {
        $this->members[] = $member;
    }

    public function getMembers() {
        return $this->members;
    }

    public function groupMembers($groupSize) {
        return array_chunk($this->members, $groupSize);
    }
}
